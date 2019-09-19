<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 17:24
 */

declare(strict_types=1);

namespace App\Factory;

use App\Handler\GraphQLHandler;
use App\Resolver\EditTapeUserHistoryDetailResolver;
use App\Resolver\EditTapeUserResolver;
use App\Resolver\EditTvShowResolver;
use App\Resolver\ImportImdbEpisodesResolver;
use App\Resolver\ImportImdbMovieResolver;
use App\Resolver\ListTapeUserResolver;
use App\Resolver\ListTvShowChapterUserResolver;
use App\Resolver\SearchResolver;
use App\Resolver\TapeResolver;
use App\Service\ResolverManager;
use GraphQL\Doctrine\DefaultFieldResolver;
use GraphQL\Error\SyntaxError;
use GraphQL\GraphQL;
use GraphQL\Language\Parser;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use GraphQL\Utils\AST;
use GraphQL\Utils\BuildSchema;
use GraphQL\Utils\SchemaPrinter;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionException;

class GraphQLHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return SchemaConfig
     * @throws ReflectionException
     */
    protected static function getSchemaConfig(ContainerInterface $container): SchemaConfig
    {
        $manager = new ResolverManager($container);

        $config = SchemaConfig::create()
            ->setQuery(new ObjectType([
                'fields' => [
                    'search' => $manager->get(SearchResolver::class),
                    'tape' => $manager->get(TapeResolver::class),
                    'listTapeUser' => $manager->get(ListTapeUserResolver::class),
                    'listTvShowChapterUser' => $manager->get(ListTvShowChapterUserResolver::class)
                ],
                'name' => 'query'
            ]))
            ->setMutation(new ObjectType([
                'fields' => [
                    'editTapeUser' => $manager->get(EditTapeUserResolver::class),
                    'editTapeUserHistoryDetail' => $manager->get(EditTapeUserHistoryDetailResolver::class),
                    'editTvShow' => $manager->get(EditTvShowResolver::class),
                    'importImdbMovie' => $manager->get(ImportImdbMovieResolver::class),
                    'importImdbEpisodes' => $manager->get(ImportImdbEpisodesResolver::class)
                ],
                'name' => 'mutation'
            ]));
        return $config;
    }

    /**
     * @param ContainerInterface $container
     * @return Schema
     * @throws ReflectionException
     */
    protected static function getSchema(ContainerInterface $container): Schema
    {
        $config = self::getSchemaConfig($container);

        $schema = new Schema($config);

        $dirname = dirname(__DIR__, 3);
        $schemaFilename = $dirname . DIRECTORY_SEPARATOR . "schema.graphql";
        file_put_contents($schemaFilename, SchemaPrinter::doPrint($schema));

        return $schema;
    }

    /**
     * @return Schema
     * @throws SyntaxError
     */
    protected static function getCachedSchema(): Schema
    {
        $dirname = dirname(__DIR__, 3);
        $cacheFilename = $dirname . DIRECTORY_SEPARATOR . "cached_schema.php";
        $schemaFilename = $dirname . DIRECTORY_SEPARATOR . "schema.graphql";

        if (!file_exists($cacheFilename)) {
            $document = Parser::parse(file_get_contents($schemaFilename));
            file_put_contents($cacheFilename, "<?php\nreturn " . var_export(AST::toArray($document), true) . ";\n");
        } else {
            $document = AST::fromArray(require $cacheFilename); // fromArray() is a lazy operation as well
        }

        $typeConfigDecorator = function($typeConfig) {
            return $typeConfig;
        };

        $schema = BuildSchema::build($document, $typeConfigDecorator);
        return $schema;
    }

    /**
     * @param ContainerInterface $container
     * @return RequestHandlerInterface
     * @throws ReflectionException
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $debug = $config['debug'] ?? false;

        GraphQL::setDefaultFieldResolver(new DefaultFieldResolver());

        $schema = self::getCachedSchema();

        return new GraphQLHandler($schema, $debug);
    }
}
