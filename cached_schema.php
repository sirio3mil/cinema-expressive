<?php
return array (
  'kind' => 'Document',
  'loc' => 
  array (
    'start' => 0,
    'end' => 9073,
  ),
  'definitions' => 
  array (
    0 => 
    array (
      'kind' => 'SchemaDefinition',
      'loc' => 
      array (
        'start' => 0,
        'end' => 46,
      ),
      'directives' => 
      array (
      ),
      'operationTypes' => 
      array (
        0 => 
        array (
          'kind' => 'OperationTypeDefinition',
          'loc' => 
          array (
            'start' => 11,
            'end' => 23,
          ),
          'operation' => 'query',
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 18,
              'end' => 23,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 18,
                'end' => 23,
              ),
              'value' => 'query',
            ),
          ),
        ),
        1 => 
        array (
          'kind' => 'OperationTypeDefinition',
          'loc' => 
          array (
            'start' => 26,
            'end' => 44,
          ),
          'operation' => 'mutation',
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 36,
              'end' => 44,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 36,
                'end' => 44,
              ),
              'value' => 'mutation',
            ),
          ),
        ),
      ),
    ),
    1 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 48,
        'end' => 187,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 73,
          'end' => 80,
        ),
        'value' => 'Country',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 85,
            'end' => 99,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 85,
              'end' => 94,
            ),
            'value' => 'countryId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 96,
              'end' => 99,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 96,
                'end' => 98,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 96,
                  'end' => 98,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 102,
            'end' => 123,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 102,
              'end' => 114,
            ),
            'value' => 'officialName',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 116,
              'end' => 123,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 116,
                'end' => 122,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 116,
                  'end' => 122,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 126,
            'end' => 141,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 126,
              'end' => 133,
            ),
            'value' => 'isoCode',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 135,
              'end' => 141,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 135,
                'end' => 141,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 144,
            'end' => 162,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 144,
              'end' => 152,
            ),
            'value' => 'language',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 154,
              'end' => 162,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 154,
                'end' => 162,
              ),
              'value' => 'Language',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 165,
            'end' => 185,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 165,
              'end' => 174,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 176,
              'end' => 185,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 176,
                'end' => 184,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 176,
                  'end' => 184,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 48,
          'end' => 67,
        ),
        'value' => 'Class Country',
        'block' => true,
      ),
    ),
    2 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 189,
        'end' => 306,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 297,
          'end' => 306,
        ),
        'value' => 'CountryID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 189,
          'end' => 289,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `Country` is needed',
        'block' => true,
      ),
    ),
    3 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 308,
        'end' => 323,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 315,
          'end' => 323,
        ),
        'value' => 'DateTime',
      ),
      'directives' => 
      array (
      ),
    ),
    4 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 325,
        'end' => 656,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 347,
          'end' => 351,
        ),
        'value' => 'File',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 356,
            'end' => 375,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 356,
              'end' => 362,
            ),
            'value' => 'season',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 364,
              'end' => 375,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 364,
                'end' => 374,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 364,
                  'end' => 374,
                ),
                'value' => 'FileSeason',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 378,
            'end' => 391,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 378,
              'end' => 382,
            ),
            'value' => 'mime',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 384,
              'end' => 391,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 384,
                'end' => 390,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 384,
                  'end' => 390,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 394,
            'end' => 407,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 394,
              'end' => 399,
            ),
            'value' => 'image',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 401,
              'end' => 407,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 401,
                'end' => 406,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 401,
                  'end' => 406,
                ),
                'value' => 'Image',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 410,
            'end' => 429,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 410,
              'end' => 418,
            ),
            'value' => 'fileType',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 420,
              'end' => 429,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 420,
                'end' => 428,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 420,
                  'end' => 428,
                ),
                'value' => 'FileType',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 432,
            'end' => 449,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 432,
              'end' => 439,
            ),
            'value' => 'deleted',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 441,
              'end' => 449,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 441,
                'end' => 448,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 441,
                  'end' => 448,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 452,
            'end' => 475,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 452,
              'end' => 464,
            ),
            'value' => 'deletionDate',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 466,
              'end' => 475,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 466,
                'end' => 474,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 466,
                  'end' => 474,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 478,
            'end' => 498,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 478,
              'end' => 490,
            ),
            'value' => 'downloadName',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 492,
              'end' => 498,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 492,
                'end' => 498,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 501,
            'end' => 519,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 501,
              'end' => 510,
            ),
            'value' => 'extension',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 512,
              'end' => 519,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 512,
                'end' => 518,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 512,
                  'end' => 518,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        8 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 522,
            'end' => 533,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 522,
              'end' => 528,
            ),
            'value' => 'fileId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 530,
              'end' => 533,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 530,
                'end' => 532,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 530,
                  'end' => 532,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        9 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 536,
            'end' => 549,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 536,
              'end' => 540,
            ),
            'value' => 'name',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 542,
              'end' => 549,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 542,
                'end' => 548,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 542,
                  'end' => 548,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        10 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 552,
            'end' => 572,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 552,
              'end' => 564,
            ),
            'value' => 'originalName',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 566,
              'end' => 572,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 566,
                'end' => 572,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        11 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 575,
            'end' => 588,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 575,
              'end' => 579,
            ),
            'value' => 'path',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 581,
              'end' => 588,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 581,
                'end' => 587,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 581,
                  'end' => 587,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        12 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 591,
            'end' => 601,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 591,
              'end' => 595,
            ),
            'value' => 'size',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 597,
              'end' => 601,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 597,
                'end' => 600,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 597,
                  'end' => 600,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        13 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 604,
            'end' => 624,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 604,
              'end' => 613,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 615,
              'end' => 624,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 615,
                'end' => 623,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 615,
                  'end' => 623,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        14 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 627,
            'end' => 654,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 627,
              'end' => 633,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 635,
              'end' => 654,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 635,
                'end' => 653,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 635,
                  'end' => 653,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 325,
          'end' => 341,
        ),
        'value' => 'Class File',
        'block' => true,
      ),
    ),
    5 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 658,
        'end' => 729,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 686,
          'end' => 696,
        ),
        'value' => 'FileSeason',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 701,
            'end' => 712,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 701,
              'end' => 705,
            ),
            'value' => 'file',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 707,
              'end' => 712,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 707,
                'end' => 711,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 707,
                  'end' => 711,
                ),
                'value' => 'File',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 715,
            'end' => 727,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 715,
              'end' => 721,
            ),
            'value' => 'season',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 723,
              'end' => 727,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 723,
                'end' => 726,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 723,
                  'end' => 726,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 658,
          'end' => 680,
        ),
        'value' => 'Class FileSeason',
        'block' => true,
      ),
    ),
    6 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 731,
        'end' => 810,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 757,
          'end' => 765,
        ),
        'value' => 'FileType',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 770,
            'end' => 785,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 770,
              'end' => 780,
            ),
            'value' => 'fileTypeId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 782,
              'end' => 785,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 782,
                'end' => 784,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 782,
                  'end' => 784,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 788,
            'end' => 808,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 788,
              'end' => 799,
            ),
            'value' => 'description',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 801,
              'end' => 808,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 801,
                'end' => 807,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 801,
                  'end' => 807,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 731,
          'end' => 751,
        ),
        'value' => 'Class FileType',
        'block' => true,
      ),
    ),
    7 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 812,
        'end' => 898,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 835,
          'end' => 840,
        ),
        'value' => 'Genre',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 845,
            'end' => 857,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 845,
              'end' => 852,
            ),
            'value' => 'genreId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 854,
              'end' => 857,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 854,
                'end' => 856,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 854,
                  'end' => 856,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 860,
            'end' => 873,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 860,
              'end' => 864,
            ),
            'value' => 'name',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 866,
              'end' => 873,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 866,
                'end' => 872,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 866,
                  'end' => 872,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 876,
            'end' => 896,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 876,
              'end' => 885,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 887,
              'end' => 896,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 887,
                'end' => 895,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 887,
                  'end' => 895,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 812,
          'end' => 829,
        ),
        'value' => 'Class Genre',
        'block' => true,
      ),
    ),
    8 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 900,
        'end' => 1176,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 924,
          'end' => 942,
        ),
        'value' => 'GlobalUniqueObject',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 947,
            'end' => 960,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 947,
              'end' => 955,
            ),
            'value' => 'objectId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 957,
              'end' => 960,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 957,
                'end' => 959,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 957,
                  'end' => 959,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 963,
            'end' => 980,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 963,
              'end' => 970,
            ),
            'value' => 'rowType',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 972,
              'end' => 980,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 972,
                'end' => 979,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 972,
                  'end' => 979,
                ),
                'value' => 'RowType',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 983,
            'end' => 1005,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 983,
              'end' => 993,
            ),
            'value' => 'imdbNumber',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 995,
              'end' => 1005,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 995,
                'end' => 1005,
              ),
              'value' => 'ImdbNumber',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1008,
            'end' => 1037,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1008,
              'end' => 1021,
            ),
            'value' => 'permanentLink',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1023,
              'end' => 1037,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1023,
                'end' => 1036,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1023,
                  'end' => 1036,
                ),
                'value' => 'PermanentLink',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1040,
            'end' => 1056,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1040,
              'end' => 1047,
            ),
            'value' => 'ranking',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1049,
              'end' => 1056,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1049,
                'end' => 1056,
              ),
              'value' => 'Ranking',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1059,
            'end' => 1073,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1059,
              'end' => 1065,
            ),
            'value' => 'people',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1067,
              'end' => 1073,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1067,
                'end' => 1073,
              ),
              'value' => 'People',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1076,
            'end' => 1086,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1076,
              'end' => 1080,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1082,
              'end' => 1086,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1082,
                'end' => 1086,
              ),
              'value' => 'Tape',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1089,
            'end' => 1102,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1089,
              'end' => 1094,
            ),
            'value' => 'files',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 1096,
              'end' => 1102,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1097,
                'end' => 1101,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1097,
                  'end' => 1101,
                ),
                'value' => 'File',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        8 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1105,
            'end' => 1132,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1105,
              'end' => 1117,
            ),
            'value' => 'searchValues',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 1119,
              'end' => 1132,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1120,
                'end' => 1131,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1120,
                  'end' => 1131,
                ),
                'value' => 'SearchValue',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        9 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1135,
            'end' => 1174,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1135,
              'end' => 1146,
            ),
            'value' => 'searchValue',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 1147,
                'end' => 1160,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1147,
                  'end' => 1151,
                ),
                'value' => 'slug',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 1153,
                  'end' => 1160,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 1153,
                    'end' => 1159,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 1153,
                      'end' => 1159,
                    ),
                    'value' => 'String',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1163,
              'end' => 1174,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1163,
                'end' => 1174,
              ),
              'value' => 'SearchValue',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 900,
          'end' => 918,
        ),
        'value' => 'Class Object',
        'block' => true,
      ),
    ),
    9 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1178,
        'end' => 1253,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1201,
          'end' => 1206,
        ),
        'value' => 'Image',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1211,
            'end' => 1222,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1211,
              'end' => 1215,
            ),
            'value' => 'file',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1217,
              'end' => 1222,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1217,
                'end' => 1221,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1217,
                  'end' => 1221,
                ),
                'value' => 'File',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1225,
            'end' => 1237,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1225,
              'end' => 1231,
            ),
            'value' => 'height',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1233,
              'end' => 1237,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1233,
                'end' => 1236,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1233,
                  'end' => 1236,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1240,
            'end' => 1251,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1240,
              'end' => 1245,
            ),
            'value' => 'width',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1247,
              'end' => 1251,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1247,
                'end' => 1250,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1247,
                  'end' => 1250,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1178,
          'end' => 1195,
        ),
        'value' => 'Class Image',
        'block' => true,
      ),
    ),
    10 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1255,
        'end' => 1360,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1283,
          'end' => 1293,
        ),
        'value' => 'ImdbNumber',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1298,
            'end' => 1314,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1298,
              'end' => 1308,
            ),
            'value' => 'imdbNumber',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1310,
              'end' => 1314,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1310,
                'end' => 1313,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1310,
                  'end' => 1313,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1317,
            'end' => 1328,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1317,
              'end' => 1320,
            ),
            'value' => 'url',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1322,
              'end' => 1328,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1322,
                'end' => 1328,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1331,
            'end' => 1358,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1331,
              'end' => 1337,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1339,
              'end' => 1358,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1339,
                'end' => 1357,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1339,
                  'end' => 1357,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1255,
          'end' => 1277,
        ),
        'value' => 'Class ImdbNumber',
        'block' => true,
      ),
    ),
    11 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1362,
        'end' => 1457,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1388,
          'end' => 1396,
        ),
        'value' => 'Language',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1401,
            'end' => 1416,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1401,
              'end' => 1411,
            ),
            'value' => 'languageId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1413,
              'end' => 1416,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1413,
                'end' => 1415,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1413,
                  'end' => 1415,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1419,
            'end' => 1432,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1419,
              'end' => 1423,
            ),
            'value' => 'name',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1425,
              'end' => 1432,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1425,
                'end' => 1431,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1425,
                  'end' => 1431,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1435,
            'end' => 1455,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1435,
              'end' => 1444,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1446,
              'end' => 1455,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1446,
                'end' => 1454,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1446,
                  'end' => 1454,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1362,
          'end' => 1382,
        ),
        'value' => 'Class Language',
        'block' => true,
      ),
    ),
    12 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1459,
        'end' => 1555,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1485,
          'end' => 1493,
        ),
        'value' => 'Location',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1498,
            'end' => 1513,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1498,
              'end' => 1508,
            ),
            'value' => 'locationId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1510,
              'end' => 1513,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1510,
                'end' => 1512,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1510,
                  'end' => 1512,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1516,
            'end' => 1530,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1516,
              'end' => 1521,
            ),
            'value' => 'place',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1523,
              'end' => 1530,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1523,
                'end' => 1529,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1523,
                  'end' => 1529,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1533,
            'end' => 1553,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1533,
              'end' => 1542,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1544,
              'end' => 1553,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1544,
                'end' => 1552,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1544,
                  'end' => 1552,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1459,
          'end' => 1479,
        ),
        'value' => 'Class Location',
        'block' => true,
      ),
    ),
    13 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1557,
        'end' => 1766,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1581,
          'end' => 1587,
        ),
        'value' => 'People',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1592,
            'end' => 1605,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1592,
              'end' => 1600,
            ),
            'value' => 'peopleId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1602,
              'end' => 1605,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1602,
                'end' => 1604,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1602,
                  'end' => 1604,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1608,
            'end' => 1625,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1608,
              'end' => 1616,
            ),
            'value' => 'fullName',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1618,
              'end' => 1625,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1618,
                'end' => 1624,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1618,
                  'end' => 1624,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1628,
            'end' => 1648,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1628,
              'end' => 1634,
            ),
            'value' => 'detail',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 1636,
              'end' => 1648,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 1636,
                'end' => 1648,
              ),
              'value' => 'PeopleDetail',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1651,
            'end' => 1673,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1651,
              'end' => 1658,
            ),
            'value' => 'aliases',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 1660,
              'end' => 1673,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1661,
                'end' => 1672,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1661,
                  'end' => 1672,
                ),
                'value' => 'PeopleAlias',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1676,
            'end' => 1711,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1676,
              'end' => 1681,
            ),
            'value' => 'alias',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 1682,
                'end' => 1696,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1682,
                  'end' => 1687,
                ),
                'value' => 'alias',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 1689,
                  'end' => 1696,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 1689,
                    'end' => 1695,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 1689,
                      'end' => 1695,
                    ),
                    'value' => 'String',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1699,
              'end' => 1711,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1699,
                'end' => 1710,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1699,
                  'end' => 1710,
                ),
                'value' => 'PeopleAlias',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1714,
            'end' => 1734,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1714,
              'end' => 1723,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1725,
              'end' => 1734,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1725,
                'end' => 1733,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1725,
                  'end' => 1733,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1737,
            'end' => 1764,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1737,
              'end' => 1743,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1745,
              'end' => 1764,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1745,
                'end' => 1763,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1745,
                  'end' => 1763,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1557,
          'end' => 1575,
        ),
        'value' => 'Class People',
        'block' => true,
      ),
    ),
    14 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1768,
        'end' => 1868,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1797,
          'end' => 1808,
        ),
        'value' => 'PeopleAlias',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1813,
            'end' => 1831,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1813,
              'end' => 1826,
            ),
            'value' => 'peopleAliasId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1828,
              'end' => 1831,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1828,
                'end' => 1830,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1828,
                  'end' => 1830,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1834,
            'end' => 1848,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1834,
              'end' => 1839,
            ),
            'value' => 'alias',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1841,
              'end' => 1848,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1841,
                'end' => 1847,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1841,
                  'end' => 1847,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 1851,
            'end' => 1866,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 1851,
              'end' => 1857,
            ),
            'value' => 'people',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 1859,
              'end' => 1866,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 1859,
                'end' => 1865,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 1859,
                  'end' => 1865,
                ),
                'value' => 'People',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1768,
          'end' => 1791,
        ),
        'value' => 'Class PeopleAlias',
        'block' => true,
      ),
    ),
    15 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 1870,
        'end' => 1995,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 1982,
          'end' => 1995,
        ),
        'value' => 'PeopleAliasID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1870,
          'end' => 1974,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `PeopleAlias` is needed',
        'block' => true,
      ),
    ),
    16 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 1997,
        'end' => 2139,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2030,
          'end' => 2045,
        ),
        'value' => 'PeopleAliasTape',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2050,
            'end' => 2072,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2050,
              'end' => 2067,
            ),
            'value' => 'peopleAliasTapeId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2069,
              'end' => 2072,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2069,
                'end' => 2071,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2069,
                  'end' => 2071,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2075,
            'end' => 2100,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2075,
              'end' => 2086,
            ),
            'value' => 'peopleAlias',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2088,
              'end' => 2100,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2088,
                'end' => 2099,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2088,
                  'end' => 2099,
                ),
                'value' => 'PeopleAlias',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2103,
            'end' => 2123,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2103,
              'end' => 2112,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2114,
              'end' => 2123,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2114,
                'end' => 2122,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2114,
                  'end' => 2122,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2126,
            'end' => 2137,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2126,
              'end' => 2130,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2132,
              'end' => 2137,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2132,
                'end' => 2136,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2132,
                  'end' => 2136,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 1997,
          'end' => 2024,
        ),
        'value' => 'Class PeopleAliasTape',
        'block' => true,
      ),
    ),
    17 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 2141,
        'end' => 2426,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2171,
          'end' => 2183,
        ),
        'value' => 'PeopleDetail',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2188,
            'end' => 2202,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2188,
              'end' => 2194,
            ),
            'value' => 'gender',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2196,
              'end' => 2202,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2196,
                'end' => 2202,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2205,
            'end' => 2224,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2205,
              'end' => 2214,
            ),
            'value' => 'havePhoto',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2216,
              'end' => 2224,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2216,
                'end' => 2223,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2216,
                  'end' => 2223,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2227,
            'end' => 2246,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2227,
              'end' => 2236,
            ),
            'value' => 'birthDate',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2238,
              'end' => 2246,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2238,
                'end' => 2246,
              ),
              'value' => 'DateTime',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2249,
            'end' => 2268,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2249,
              'end' => 2258,
            ),
            'value' => 'deathDate',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2260,
              'end' => 2268,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2260,
                'end' => 2268,
              ),
              'value' => 'DateTime',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2271,
            'end' => 2289,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2271,
              'end' => 2281,
            ),
            'value' => 'birthPlace',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2283,
              'end' => 2289,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2283,
                'end' => 2289,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2292,
            'end' => 2310,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2292,
              'end' => 2302,
            ),
            'value' => 'deathPlace',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2304,
              'end' => 2310,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2304,
                'end' => 2310,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2313,
            'end' => 2324,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2313,
              'end' => 2319,
            ),
            'value' => 'height',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2321,
              'end' => 2324,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2321,
                'end' => 2324,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2327,
            'end' => 2341,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2327,
              'end' => 2331,
            ),
            'value' => 'skip',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2333,
              'end' => 2341,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2333,
                'end' => 2340,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2333,
                  'end' => 2340,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        8 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2344,
            'end' => 2359,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2344,
              'end' => 2350,
            ),
            'value' => 'people',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2352,
              'end' => 2359,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2352,
                'end' => 2358,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2352,
                  'end' => 2358,
                ),
                'value' => 'People',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        9 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2362,
            'end' => 2382,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2362,
              'end' => 2371,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2373,
              'end' => 2382,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2373,
                'end' => 2381,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2373,
                  'end' => 2381,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        10 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2385,
            'end' => 2405,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2385,
              'end' => 2394,
            ),
            'value' => 'updatedAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2396,
              'end' => 2405,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2396,
                'end' => 2404,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2396,
                  'end' => 2404,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        11 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2408,
            'end' => 2424,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2408,
              'end' => 2415,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2417,
              'end' => 2424,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2417,
                'end' => 2424,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2141,
          'end' => 2165,
        ),
        'value' => 'Class PeopleDetail',
        'block' => true,
      ),
    ),
    18 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 2428,
        'end' => 2543,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2535,
          'end' => 2543,
        ),
        'value' => 'PeopleID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2428,
          'end' => 2527,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `People` is needed',
        'block' => true,
      ),
    ),
    19 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 2545,
        'end' => 2638,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2576,
          'end' => 2589,
        ),
        'value' => 'PermanentLink',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2594,
            'end' => 2606,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2594,
              'end' => 2597,
            ),
            'value' => 'url',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2599,
              'end' => 2606,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2599,
                'end' => 2605,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2599,
                  'end' => 2605,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2609,
            'end' => 2636,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2609,
              'end' => 2615,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2617,
              'end' => 2636,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2617,
                'end' => 2635,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2617,
                  'end' => 2635,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2545,
          'end' => 2570,
        ),
        'value' => 'Class PermanentLink',
        'block' => true,
      ),
    ),
    20 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 2640,
        'end' => 2710,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2663,
          'end' => 2668,
        ),
        'value' => 'Place',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2673,
            'end' => 2685,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2673,
              'end' => 2680,
            ),
            'value' => 'placeId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2682,
              'end' => 2685,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2682,
                'end' => 2684,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2682,
                  'end' => 2684,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2688,
            'end' => 2708,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2688,
              'end' => 2699,
            ),
            'value' => 'description',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2701,
              'end' => 2708,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2701,
                'end' => 2707,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2701,
                  'end' => 2707,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2640,
          'end' => 2657,
        ),
        'value' => 'Class Place',
        'block' => true,
      ),
    ),
    21 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 2712,
        'end' => 2825,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2818,
          'end' => 2825,
        ),
        'value' => 'PlaceID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2712,
          'end' => 2810,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `Place` is needed',
        'block' => true,
      ),
    ),
    22 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 2827,
        'end' => 3049,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 2853,
          'end' => 2861,
        ),
        'value' => 'Premiere',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2866,
            'end' => 2881,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2866,
              'end' => 2876,
            ),
            'value' => 'premiereId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2878,
              'end' => 2881,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2878,
                'end' => 2880,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2878,
                  'end' => 2880,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2884,
            'end' => 2899,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2884,
              'end' => 2888,
            ),
            'value' => 'date',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2890,
              'end' => 2899,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2890,
                'end' => 2898,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2890,
                  'end' => 2898,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2902,
            'end' => 2916,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2902,
              'end' => 2907,
            ),
            'value' => 'place',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 2909,
              'end' => 2916,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2909,
                'end' => 2915,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2909,
                  'end' => 2915,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2919,
            'end' => 2944,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2919,
              'end' => 2926,
            ),
            'value' => 'details',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 2928,
              'end' => 2944,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 2929,
                'end' => 2943,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2929,
                  'end' => 2943,
                ),
                'value' => 'PremiereDetail',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2947,
            'end' => 2991,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2947,
              'end' => 2953,
            ),
            'value' => 'detail',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 2954,
                'end' => 2974,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 2954,
                  'end' => 2965,
                ),
                'value' => 'observation',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 2967,
                  'end' => 2974,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 2967,
                    'end' => 2973,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 2967,
                      'end' => 2973,
                    ),
                    'value' => 'String',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 2977,
              'end' => 2991,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 2977,
                'end' => 2991,
              ),
              'value' => 'PremiereDetail',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 2994,
            'end' => 3005,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 2994,
              'end' => 2998,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3000,
              'end' => 3005,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3000,
                'end' => 3004,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3000,
                  'end' => 3004,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3008,
            'end' => 3024,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3008,
              'end' => 3015,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 3017,
              'end' => 3024,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 3017,
                'end' => 3024,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3027,
            'end' => 3047,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3027,
              'end' => 3036,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3038,
              'end' => 3047,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3038,
                'end' => 3046,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3038,
                  'end' => 3046,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 2827,
          'end' => 2847,
        ),
        'value' => 'Class Premiere',
        'block' => true,
      ),
    ),
    23 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3051,
        'end' => 3193,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3083,
          'end' => 3097,
        ),
        'value' => 'PremiereDetail',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3102,
            'end' => 3123,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3102,
              'end' => 3118,
            ),
            'value' => 'premiereDetailId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3120,
              'end' => 3123,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3120,
                'end' => 3122,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3120,
                  'end' => 3122,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3126,
            'end' => 3146,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3126,
              'end' => 3137,
            ),
            'value' => 'observation',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3139,
              'end' => 3146,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3139,
                'end' => 3145,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3139,
                  'end' => 3145,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3149,
            'end' => 3168,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3149,
              'end' => 3157,
            ),
            'value' => 'premiere',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3159,
              'end' => 3168,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3159,
                'end' => 3167,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3159,
                  'end' => 3167,
                ),
                'value' => 'Premiere',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3171,
            'end' => 3191,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3171,
              'end' => 3180,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3182,
              'end' => 3191,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3182,
                'end' => 3190,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3182,
                  'end' => 3190,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3051,
          'end' => 3077,
        ),
        'value' => 'Class PremiereDetail',
        'block' => true,
      ),
    ),
    24 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3195,
        'end' => 3286,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3221,
          'end' => 3229,
        ),
        'value' => 'Producer',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3234,
            'end' => 3249,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3234,
              'end' => 3244,
            ),
            'value' => 'producerId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3246,
              'end' => 3249,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3246,
                'end' => 3248,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3246,
                  'end' => 3248,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3252,
            'end' => 3265,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3252,
              'end' => 3256,
            ),
            'value' => 'name',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3258,
              'end' => 3265,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3258,
                'end' => 3264,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3258,
                  'end' => 3264,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3268,
            'end' => 3284,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3268,
              'end' => 3275,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 3277,
              'end' => 3284,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 3277,
                'end' => 3284,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3195,
          'end' => 3215,
        ),
        'value' => 'Class Producer',
        'block' => true,
      ),
    ),
    25 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3288,
        'end' => 3410,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3313,
          'end' => 3320,
        ),
        'value' => 'Ranking',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3325,
            'end' => 3336,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3325,
              'end' => 3330,
            ),
            'value' => 'votes',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3332,
              'end' => 3336,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3332,
                'end' => 3335,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3332,
                  'end' => 3335,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3339,
            'end' => 3352,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3339,
              'end' => 3344,
            ),
            'value' => 'score',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3346,
              'end' => 3352,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3346,
                'end' => 3351,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3346,
                  'end' => 3351,
                ),
                'value' => 'Float',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3355,
            'end' => 3378,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3355,
              'end' => 3370,
            ),
            'value' => 'calculatedScore',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3372,
              'end' => 3378,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3372,
                'end' => 3377,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3372,
                  'end' => 3377,
                ),
                'value' => 'Float',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3381,
            'end' => 3408,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3381,
              'end' => 3387,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3389,
              'end' => 3408,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3389,
                'end' => 3407,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3389,
                  'end' => 3407,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3288,
          'end' => 3307,
        ),
        'value' => 'Class Ranking',
        'block' => true,
      ),
    ),
    26 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3412,
        'end' => 3472,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3434,
          'end' => 3438,
        ),
        'value' => 'Role',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3443,
            'end' => 3454,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3443,
              'end' => 3449,
            ),
            'value' => 'roleId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3451,
              'end' => 3454,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3451,
                'end' => 3453,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3451,
                  'end' => 3453,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3457,
            'end' => 3470,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3457,
              'end' => 3461,
            ),
            'value' => 'role',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3463,
              'end' => 3470,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3463,
                'end' => 3469,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3463,
                  'end' => 3469,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3412,
          'end' => 3428,
        ),
        'value' => 'Class Role',
        'block' => true,
      ),
    ),
    27 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 3474,
        'end' => 3585,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3579,
          'end' => 3585,
        ),
        'value' => 'RoleID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3474,
          'end' => 3571,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `Role` is needed',
        'block' => true,
      ),
    ),
    28 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3587,
        'end' => 3663,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3612,
          'end' => 3619,
        ),
        'value' => 'RowType',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3624,
            'end' => 3638,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3624,
              'end' => 3633,
            ),
            'value' => 'rowTypeId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3635,
              'end' => 3638,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3635,
                'end' => 3637,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3635,
                  'end' => 3637,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3641,
            'end' => 3661,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3641,
              'end' => 3652,
            ),
            'value' => 'description',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3654,
              'end' => 3661,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3654,
                'end' => 3660,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3654,
                  'end' => 3660,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3587,
          'end' => 3606,
        ),
        'value' => 'Class RowType',
        'block' => true,
      ),
    ),
    29 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3665,
        'end' => 3824,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3694,
          'end' => 3705,
        ),
        'value' => 'SearchValue',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3710,
            'end' => 3728,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3710,
              'end' => 3723,
            ),
            'value' => 'searchValueId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3725,
              'end' => 3728,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3725,
                'end' => 3727,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3725,
                  'end' => 3727,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3731,
            'end' => 3751,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3731,
              'end' => 3742,
            ),
            'value' => 'searchParam',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3744,
              'end' => 3751,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3744,
                'end' => 3750,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3744,
                  'end' => 3750,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3754,
            'end' => 3776,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3754,
              'end' => 3766,
            ),
            'value' => 'primaryParam',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3768,
              'end' => 3776,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3768,
                'end' => 3775,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3768,
                  'end' => 3775,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3779,
            'end' => 3792,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3779,
              'end' => 3783,
            ),
            'value' => 'slug',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3785,
              'end' => 3792,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3785,
                'end' => 3791,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3785,
                  'end' => 3791,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3795,
            'end' => 3822,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3795,
              'end' => 3801,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3803,
              'end' => 3822,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3803,
                'end' => 3821,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3803,
                  'end' => 3821,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3665,
          'end' => 3688,
        ),
        'value' => 'Class SearchValue',
        'block' => true,
      ),
    ),
    30 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3826,
        'end' => 3919,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3849,
          'end' => 3854,
        ),
        'value' => 'Sound',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3859,
            'end' => 3871,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3859,
              'end' => 3866,
            ),
            'value' => 'soundId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3868,
              'end' => 3871,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3868,
                'end' => 3870,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3868,
                  'end' => 3870,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3874,
            'end' => 3894,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3874,
              'end' => 3885,
            ),
            'value' => 'description',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3887,
              'end' => 3894,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3887,
                'end' => 3893,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3887,
                  'end' => 3893,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3897,
            'end' => 3917,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3897,
              'end' => 3906,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3908,
              'end' => 3917,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3908,
                'end' => 3916,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3908,
                  'end' => 3916,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3826,
          'end' => 3843,
        ),
        'value' => 'Class Sound',
        'block' => true,
      ),
    ),
    31 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 3921,
        'end' => 4004,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 3942,
          'end' => 3945,
        ),
        'value' => 'Tag',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3950,
            'end' => 3960,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3950,
              'end' => 3955,
            ),
            'value' => 'tagId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3957,
              'end' => 3960,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3957,
                'end' => 3959,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3957,
                  'end' => 3959,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3963,
            'end' => 3979,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3963,
              'end' => 3970,
            ),
            'value' => 'keyword',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3972,
              'end' => 3979,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3972,
                'end' => 3978,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3972,
                  'end' => 3978,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 3982,
            'end' => 4002,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 3982,
              'end' => 3991,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 3993,
              'end' => 4002,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 3993,
                'end' => 4001,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 3993,
                  'end' => 4001,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 3921,
          'end' => 3936,
        ),
        'value' => 'Class Tag',
        'block' => true,
      ),
    ),
    32 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 4006,
        'end' => 4891,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 4028,
          'end' => 4032,
        ),
        'value' => 'Tape',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4037,
            'end' => 4048,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4037,
              'end' => 4043,
            ),
            'value' => 'tapeId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4045,
              'end' => 4048,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4045,
                'end' => 4047,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4045,
                  'end' => 4047,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4051,
            'end' => 4073,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4051,
              'end' => 4064,
            ),
            'value' => 'originalTitle',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4066,
              'end' => 4073,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4066,
                'end' => 4072,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4066,
                  'end' => 4072,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4076,
            'end' => 4097,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4076,
              'end' => 4085,
            ),
            'value' => 'countries',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4087,
              'end' => 4097,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4087,
                'end' => 4096,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4088,
                  'end' => 4095,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4088,
                    'end' => 4095,
                  ),
                  'value' => 'Country',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4100,
            'end' => 4116,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4100,
              'end' => 4106,
            ),
            'value' => 'genres',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4108,
              'end' => 4116,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4108,
                'end' => 4115,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4109,
                  'end' => 4114,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4109,
                    'end' => 4114,
                  ),
                  'value' => 'Genre',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4119,
            'end' => 4140,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4119,
              'end' => 4128,
            ),
            'value' => 'languages',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4130,
              'end' => 4140,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4131,
                'end' => 4139,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4131,
                  'end' => 4139,
                ),
                'value' => 'Language',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4143,
            'end' => 4165,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4143,
              'end' => 4152,
            ),
            'value' => 'locations',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4154,
              'end' => 4165,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4154,
                'end' => 4164,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4155,
                  'end' => 4163,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4155,
                    'end' => 4163,
                  ),
                  'value' => 'Location',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4168,
            'end' => 4190,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4168,
              'end' => 4177,
            ),
            'value' => 'producers',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4179,
              'end' => 4190,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4179,
                'end' => 4189,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4180,
                  'end' => 4188,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4180,
                    'end' => 4188,
                  ),
                  'value' => 'Producer',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4193,
            'end' => 4205,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4193,
              'end' => 4197,
            ),
            'value' => 'tags',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4199,
              'end' => 4205,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4199,
                'end' => 4204,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4200,
                  'end' => 4203,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4200,
                    'end' => 4203,
                  ),
                  'value' => 'Tag',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        8 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4208,
            'end' => 4224,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4208,
              'end' => 4214,
            ),
            'value' => 'sounds',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4216,
              'end' => 4224,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4216,
                'end' => 4223,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4217,
                  'end' => 4222,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4217,
                    'end' => 4222,
                  ),
                  'value' => 'Sound',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        9 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4227,
            'end' => 4253,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4227,
              'end' => 4234,
            ),
            'value' => 'default',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4236,
              'end' => 4253,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4236,
                'end' => 4252,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4236,
                  'end' => 4252,
                ),
                'value' => 'TapeDefaultValue',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        10 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4256,
            'end' => 4274,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4256,
              'end' => 4262,
            ),
            'value' => 'detail',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4264,
              'end' => 4274,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4264,
                'end' => 4274,
              ),
              'value' => 'TapeDetail',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        11 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4277,
            'end' => 4291,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4277,
              'end' => 4281,
            ),
            'value' => 'plot',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4283,
              'end' => 4291,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4283,
                'end' => 4291,
              ),
              'value' => 'TapePlot',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        12 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4294,
            'end' => 4308,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4294,
              'end' => 4300,
            ),
            'value' => 'tvShow',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4302,
              'end' => 4308,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4302,
                'end' => 4308,
              ),
              'value' => 'TvShow',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        13 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4311,
            'end' => 4339,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4311,
              'end' => 4324,
            ),
            'value' => 'tvShowChapter',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4326,
              'end' => 4339,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4326,
                'end' => 4339,
              ),
              'value' => 'TvShowChapter',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        14 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4342,
            'end' => 4360,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4342,
              'end' => 4347,
            ),
            'value' => 'users',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4349,
              'end' => 4360,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 4349,
                'end' => 4359,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4350,
                  'end' => 4358,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4350,
                    'end' => 4358,
                  ),
                  'value' => 'TapeUser',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        15 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4363,
            'end' => 4396,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4363,
              'end' => 4371,
            ),
            'value' => 'tapeUser',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4372,
                'end' => 4385,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4372,
                  'end' => 4376,
                ),
                'value' => 'user',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4378,
                  'end' => 4385,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4378,
                    'end' => 4384,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4378,
                      'end' => 4384,
                    ),
                    'value' => 'UserID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4388,
              'end' => 4396,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4388,
                'end' => 4396,
              ),
              'value' => 'TapeUser',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        16 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4399,
            'end' => 4463,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4399,
              'end' => 4413,
            ),
            'value' => 'tapePeopleRole',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4414,
                'end' => 4431,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4414,
                  'end' => 4420,
                ),
                'value' => 'people',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4422,
                  'end' => 4431,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4422,
                    'end' => 4430,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4422,
                      'end' => 4430,
                    ),
                    'value' => 'PeopleID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4433,
                'end' => 4446,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4433,
                  'end' => 4437,
                ),
                'value' => 'role',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4439,
                  'end' => 4446,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4439,
                    'end' => 4445,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4439,
                      'end' => 4445,
                    ),
                    'value' => 'RoleID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4449,
              'end' => 4463,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4449,
                'end' => 4463,
              ),
              'value' => 'TapePeopleRole',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        17 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4466,
            'end' => 4490,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4466,
              'end' => 4472,
            ),
            'value' => 'people',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4474,
              'end' => 4490,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4475,
                'end' => 4489,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4475,
                  'end' => 4489,
                ),
                'value' => 'TapePeopleRole',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        18 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4493,
            'end' => 4519,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4493,
              'end' => 4500,
            ),
            'value' => 'aliases',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4502,
              'end' => 4519,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4503,
                'end' => 4518,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4503,
                  'end' => 4518,
                ),
                'value' => 'PeopleAliasTape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        19 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4522,
            'end' => 4583,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4522,
              'end' => 4537,
            ),
            'value' => 'peopleAliasTape',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4538,
                'end' => 4565,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4538,
                  'end' => 4549,
                ),
                'value' => 'peopleAlias',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4551,
                  'end' => 4565,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4551,
                    'end' => 4564,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4551,
                      'end' => 4564,
                    ),
                    'value' => 'PeopleAliasID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4568,
              'end' => 4583,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4568,
                'end' => 4583,
              ),
              'value' => 'PeopleAliasTape',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        20 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4586,
            'end' => 4607,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4586,
              'end' => 4595,
            ),
            'value' => 'premieres',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4597,
              'end' => 4607,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4598,
                'end' => 4606,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4598,
                  'end' => 4606,
                ),
                'value' => 'Premiere',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        21 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4610,
            'end' => 4665,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4610,
              'end' => 4618,
            ),
            'value' => 'premiere',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4619,
                'end' => 4637,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4619,
                  'end' => 4626,
                ),
                'value' => 'country',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4628,
                  'end' => 4637,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4628,
                    'end' => 4637,
                  ),
                  'value' => 'CountryID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4639,
                'end' => 4654,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4639,
                  'end' => 4643,
                ),
                'value' => 'date',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4645,
                  'end' => 4654,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4645,
                    'end' => 4653,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4645,
                      'end' => 4653,
                    ),
                    'value' => 'DateTime',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4657,
              'end' => 4665,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4657,
                'end' => 4665,
              ),
              'value' => 'Premiere',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        22 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4668,
            'end' => 4687,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4668,
              'end' => 4674,
            ),
            'value' => 'titles',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4676,
              'end' => 4687,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4677,
                'end' => 4686,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4677,
                  'end' => 4686,
                ),
                'value' => 'TapeTitle',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        23 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4690,
            'end' => 4742,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4690,
              'end' => 4695,
            ),
            'value' => 'title',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4696,
                'end' => 4714,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4696,
                  'end' => 4703,
                ),
                'value' => 'country',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 4705,
                  'end' => 4714,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 4705,
                    'end' => 4714,
                  ),
                  'value' => 'CountryID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4716,
                'end' => 4730,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4716,
                  'end' => 4721,
                ),
                'value' => 'title',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4723,
                  'end' => 4730,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4723,
                    'end' => 4729,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4723,
                      'end' => 4729,
                    ),
                    'value' => 'String',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4733,
              'end' => 4742,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4733,
                'end' => 4742,
              ),
              'value' => 'TapeTitle',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        24 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4745,
            'end' => 4780,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4745,
              'end' => 4759,
            ),
            'value' => 'certifications',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 4761,
              'end' => 4780,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4762,
                'end' => 4779,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4762,
                  'end' => 4779,
                ),
                'value' => 'TapeCertification',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        25 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4783,
            'end' => 4836,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4783,
              'end' => 4796,
            ),
            'value' => 'certification',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 4797,
                'end' => 4816,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4797,
                  'end' => 4804,
                ),
                'value' => 'country',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 4806,
                  'end' => 4816,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 4806,
                    'end' => 4815,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 4806,
                      'end' => 4815,
                    ),
                    'value' => 'CountryID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4819,
              'end' => 4836,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4819,
                'end' => 4836,
              ),
              'value' => 'TapeCertification',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        26 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4839,
            'end' => 4859,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4839,
              'end' => 4848,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4850,
              'end' => 4859,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4850,
                'end' => 4858,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4850,
                  'end' => 4858,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        27 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4862,
            'end' => 4889,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4862,
              'end' => 4868,
            ),
            'value' => 'object',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4870,
              'end' => 4889,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4870,
                'end' => 4888,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4870,
                  'end' => 4888,
                ),
                'value' => 'GlobalUniqueObject',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 4006,
          'end' => 4022,
        ),
        'value' => 'Class Tape',
        'block' => true,
      ),
    ),
    33 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 4893,
        'end' => 5056,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 4928,
          'end' => 4945,
        ),
        'value' => 'TapeCertification',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4950,
            'end' => 4974,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4950,
              'end' => 4969,
            ),
            'value' => 'tapeCertificationId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 4971,
              'end' => 4974,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 4971,
                'end' => 4973,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 4971,
                  'end' => 4973,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 4977,
            'end' => 4998,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 4977,
              'end' => 4990,
            ),
            'value' => 'certification',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 4992,
              'end' => 4998,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 4992,
                'end' => 4998,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5001,
            'end' => 5012,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5001,
              'end' => 5005,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5007,
              'end' => 5012,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5007,
                'end' => 5011,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5007,
                  'end' => 5011,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5015,
            'end' => 5031,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5015,
              'end' => 5022,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5024,
              'end' => 5031,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5024,
                'end' => 5031,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5034,
            'end' => 5054,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5034,
              'end' => 5043,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5045,
              'end' => 5054,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5045,
                'end' => 5053,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5045,
                  'end' => 5053,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 4893,
          'end' => 4922,
        ),
        'value' => 'Class TapeCertification',
        'block' => true,
      ),
    ),
    34 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5058,
        'end' => 5201,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5092,
          'end' => 5108,
        ),
        'value' => 'TapeDefaultValue',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5113,
            'end' => 5132,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5113,
              'end' => 5118,
            ),
            'value' => 'title',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5120,
              'end' => 5132,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5120,
                'end' => 5131,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5120,
                  'end' => 5131,
                ),
                'value' => 'SearchValue',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5135,
            'end' => 5147,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5135,
              'end' => 5139,
            ),
            'value' => 'cast',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5141,
              'end' => 5147,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5141,
                'end' => 5147,
              ),
              'value' => 'People',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5150,
            'end' => 5166,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5150,
              'end' => 5158,
            ),
            'value' => 'director',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5160,
              'end' => 5166,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5160,
                'end' => 5166,
              ),
              'value' => 'People',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5169,
            'end' => 5180,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5169,
              'end' => 5173,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5175,
              'end' => 5180,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5175,
                'end' => 5179,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5175,
                  'end' => 5179,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5183,
            'end' => 5199,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5183,
              'end' => 5190,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5192,
              'end' => 5199,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5192,
                'end' => 5199,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5058,
          'end' => 5086,
        ),
        'value' => 'Class TapeDefaultValue',
        'block' => true,
      ),
    ),
    35 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5203,
        'end' => 5472,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5231,
          'end' => 5241,
        ),
        'value' => 'TapeDetail',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5246,
            'end' => 5255,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5246,
              'end' => 5250,
            ),
            'value' => 'year',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5252,
              'end' => 5255,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5252,
                'end' => 5255,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5258,
            'end' => 5271,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5258,
              'end' => 5266,
            ),
            'value' => 'duration',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5268,
              'end' => 5271,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5268,
                'end' => 5271,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5274,
            'end' => 5287,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5274,
              'end' => 5279,
            ),
            'value' => 'color',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5281,
              'end' => 5287,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5281,
                'end' => 5287,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5290,
            'end' => 5309,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5290,
              'end' => 5299,
            ),
            'value' => 'haveCover',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5301,
              'end' => 5309,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5301,
                'end' => 5308,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5301,
                  'end' => 5308,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5312,
            'end' => 5330,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5312,
              'end' => 5320,
            ),
            'value' => 'isTvShow',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5322,
              'end' => 5330,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5322,
                'end' => 5329,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5322,
                  'end' => 5329,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5333,
            'end' => 5348,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5333,
              'end' => 5338,
            ),
            'value' => 'adult',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5340,
              'end' => 5348,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5340,
                'end' => 5347,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5340,
                  'end' => 5347,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5351,
            'end' => 5365,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5351,
              'end' => 5357,
            ),
            'value' => 'budget',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5359,
              'end' => 5365,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5359,
                'end' => 5364,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5359,
                  'end' => 5364,
                ),
                'value' => 'Float',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        7 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5368,
            'end' => 5382,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5368,
              'end' => 5376,
            ),
            'value' => 'currency',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5378,
              'end' => 5382,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5378,
                'end' => 5381,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5378,
                  'end' => 5381,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        8 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5385,
            'end' => 5410,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5385,
              'end' => 5400,
            ),
            'value' => 'isTvShowChapter',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5402,
              'end' => 5410,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5402,
                'end' => 5409,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5402,
                  'end' => 5409,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        9 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5413,
            'end' => 5433,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5413,
              'end' => 5422,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5424,
              'end' => 5433,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5424,
                'end' => 5432,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5424,
                  'end' => 5432,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        10 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5436,
            'end' => 5456,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5436,
              'end' => 5445,
            ),
            'value' => 'updatedAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5447,
              'end' => 5456,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5447,
                'end' => 5455,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5447,
                  'end' => 5455,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        11 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5459,
            'end' => 5470,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5459,
              'end' => 5463,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5465,
              'end' => 5470,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5465,
                'end' => 5469,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5465,
                  'end' => 5469,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5203,
          'end' => 5225,
        ),
        'value' => 'Class TapeDetail',
        'block' => true,
      ),
    ),
    36 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 5474,
        'end' => 5585,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5579,
          'end' => 5585,
        ),
        'value' => 'TapeID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5474,
          'end' => 5571,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `Tape` is needed',
        'block' => true,
      ),
    ),
    37 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5587,
        'end' => 5767,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5619,
          'end' => 5633,
        ),
        'value' => 'TapePeopleRole',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5638,
            'end' => 5659,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5638,
              'end' => 5654,
            ),
            'value' => 'tapePeopleRoleId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5656,
              'end' => 5659,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5656,
                'end' => 5658,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5656,
                  'end' => 5658,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5662,
            'end' => 5677,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5662,
              'end' => 5668,
            ),
            'value' => 'people',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5670,
              'end' => 5677,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5670,
                'end' => 5676,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5670,
                  'end' => 5676,
                ),
                'value' => 'People',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5680,
            'end' => 5691,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5680,
              'end' => 5684,
            ),
            'value' => 'role',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5686,
              'end' => 5691,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5686,
                'end' => 5690,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5686,
                  'end' => 5690,
                ),
                'value' => 'Role',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5694,
            'end' => 5728,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5694,
              'end' => 5703,
            ),
            'value' => 'character',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 5705,
              'end' => 5728,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 5705,
                'end' => 5728,
              ),
              'value' => 'TapePeopleRoleCharacter',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5731,
            'end' => 5751,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5731,
              'end' => 5740,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5742,
              'end' => 5751,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5742,
                'end' => 5750,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5742,
                  'end' => 5750,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5754,
            'end' => 5765,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5754,
              'end' => 5758,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5760,
              'end' => 5765,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5760,
                'end' => 5764,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5760,
                  'end' => 5764,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5587,
          'end' => 5613,
        ),
        'value' => 'Class TapePeopleRole',
        'block' => true,
      ),
    ),
    38 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5769,
        'end' => 5915,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5810,
          'end' => 5833,
        ),
        'value' => 'TapePeopleRoleCharacter',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5838,
            'end' => 5856,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5838,
              'end' => 5847,
            ),
            'value' => 'character',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5849,
              'end' => 5856,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5849,
                'end' => 5855,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5849,
                  'end' => 5855,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5859,
            'end' => 5890,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5859,
              'end' => 5873,
            ),
            'value' => 'tapePeopleRole',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5875,
              'end' => 5890,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5875,
                'end' => 5889,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5875,
                  'end' => 5889,
                ),
                'value' => 'TapePeopleRole',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5893,
            'end' => 5913,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5893,
              'end' => 5902,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5904,
              'end' => 5913,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5904,
                'end' => 5912,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5904,
                  'end' => 5912,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5769,
          'end' => 5804,
        ),
        'value' => 'Class TapePeopleRoleCharacter',
        'block' => true,
      ),
    ),
    39 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5917,
        'end' => 5985,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 5943,
          'end' => 5951,
        ),
        'value' => 'TapePlot',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5956,
            'end' => 5969,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5956,
              'end' => 5960,
            ),
            'value' => 'plot',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5962,
              'end' => 5969,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5962,
                'end' => 5968,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5962,
                  'end' => 5968,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 5972,
            'end' => 5983,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 5972,
              'end' => 5976,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 5978,
              'end' => 5983,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 5978,
                'end' => 5982,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 5978,
                  'end' => 5982,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5917,
          'end' => 5937,
        ),
        'value' => 'Class TapePlot',
        'block' => true,
      ),
    ),
    40 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 5987,
        'end' => 6140,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6014,
          'end' => 6023,
        ),
        'value' => 'TapeTitle',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6028,
            'end' => 6044,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6028,
              'end' => 6039,
            ),
            'value' => 'tapeTitleId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6041,
              'end' => 6044,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6041,
                'end' => 6043,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6041,
                  'end' => 6043,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6047,
            'end' => 6061,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6047,
              'end' => 6052,
            ),
            'value' => 'title',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6054,
              'end' => 6061,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6054,
                'end' => 6060,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6054,
                  'end' => 6060,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6064,
            'end' => 6084,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6064,
              'end' => 6076,
            ),
            'value' => 'observations',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6078,
              'end' => 6084,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6078,
                'end' => 6084,
              ),
              'value' => 'String',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6087,
            'end' => 6105,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6087,
              'end' => 6095,
            ),
            'value' => 'language',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6097,
              'end' => 6105,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6097,
                'end' => 6105,
              ),
              'value' => 'Language',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6108,
            'end' => 6119,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6108,
              'end' => 6112,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6114,
              'end' => 6119,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6114,
                'end' => 6118,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6114,
                  'end' => 6118,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6122,
            'end' => 6138,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6122,
              'end' => 6129,
            ),
            'value' => 'country',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6131,
              'end' => 6138,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6131,
                'end' => 6138,
              ),
              'value' => 'Country',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 5987,
          'end' => 6008,
        ),
        'value' => 'Class TapeTitle',
        'block' => true,
      ),
    ),
    41 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 6142,
        'end' => 6372,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6168,
          'end' => 6176,
        ),
        'value' => 'TapeUser',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6181,
            'end' => 6196,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6181,
              'end' => 6191,
            ),
            'value' => 'tapeUserId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6193,
              'end' => 6196,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6193,
                'end' => 6195,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6193,
                  'end' => 6195,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6199,
            'end' => 6210,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6199,
              'end' => 6203,
            ),
            'value' => 'user',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6205,
              'end' => 6210,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6205,
                'end' => 6209,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6205,
                  'end' => 6209,
                ),
                'value' => 'User',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6213,
            'end' => 6233,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6213,
              'end' => 6218,
            ),
            'value' => 'score',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6220,
              'end' => 6233,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6220,
                'end' => 6233,
              ),
              'value' => 'TapeUserScore',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6236,
            'end' => 6263,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6236,
              'end' => 6243,
            ),
            'value' => 'history',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6245,
              'end' => 6263,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 6245,
                'end' => 6262,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 6246,
                  'end' => 6261,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 6246,
                    'end' => 6261,
                  ),
                  'value' => 'TapeUserHistory',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6266,
            'end' => 6333,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6266,
              'end' => 6281,
            ),
            'value' => 'historyByStatus',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 6282,
                'end' => 6315,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6282,
                  'end' => 6296,
                ),
                'value' => 'tapeUserStatus',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 6298,
                  'end' => 6315,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 6298,
                    'end' => 6314,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 6298,
                      'end' => 6314,
                    ),
                    'value' => 'TapeUserStatusID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6318,
              'end' => 6333,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6318,
                'end' => 6333,
              ),
              'value' => 'TapeUserHistory',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6336,
            'end' => 6356,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6336,
              'end' => 6345,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6347,
              'end' => 6356,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6347,
                'end' => 6355,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6347,
                  'end' => 6355,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6359,
            'end' => 6370,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6359,
              'end' => 6363,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6365,
              'end' => 6370,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6365,
                'end' => 6369,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6365,
                  'end' => 6369,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 6142,
          'end' => 6162,
        ),
        'value' => 'Class TapeUser',
        'block' => true,
      ),
    ),
    42 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 6374,
        'end' => 6561,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6407,
          'end' => 6422,
        ),
        'value' => 'TapeUserHistory',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6427,
            'end' => 6449,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6427,
              'end' => 6444,
            ),
            'value' => 'tapeUserHistoryId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6446,
              'end' => 6449,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6446,
                'end' => 6448,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6446,
                  'end' => 6448,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6452,
            'end' => 6471,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6452,
              'end' => 6460,
            ),
            'value' => 'tapeUser',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6462,
              'end' => 6471,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6462,
                'end' => 6470,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6462,
                  'end' => 6470,
                ),
                'value' => 'TapeUser',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6474,
            'end' => 6504,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6474,
              'end' => 6488,
            ),
            'value' => 'tapeUserStatus',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6490,
              'end' => 6504,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6490,
                'end' => 6504,
              ),
              'value' => 'TapeUserStatus',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6507,
            'end' => 6536,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6507,
              'end' => 6513,
            ),
            'value' => 'detail',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6515,
              'end' => 6536,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6515,
                'end' => 6536,
              ),
              'value' => 'TapeUserHistoryDetail',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6539,
            'end' => 6559,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6539,
              'end' => 6548,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6550,
              'end' => 6559,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6550,
                'end' => 6558,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6550,
                  'end' => 6558,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 6374,
          'end' => 6401,
        ),
        'value' => 'Class TapeUserHistory',
        'block' => true,
      ),
    ),
    43 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 6563,
        'end' => 6765,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6602,
          'end' => 6623,
        ),
        'value' => 'TapeUserHistoryDetail',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6628,
            'end' => 6661,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6628,
              'end' => 6643,
            ),
            'value' => 'tapeUserHistory',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6645,
              'end' => 6661,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6645,
                'end' => 6660,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6645,
                  'end' => 6660,
                ),
                'value' => 'TapeUserHistory',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6664,
            'end' => 6681,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6664,
              'end' => 6671,
            ),
            'value' => 'visible',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6673,
              'end' => 6681,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6673,
                'end' => 6680,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6673,
                  'end' => 6680,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6684,
            'end' => 6702,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6684,
              'end' => 6692,
            ),
            'value' => 'exported',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6694,
              'end' => 6702,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6694,
                'end' => 6701,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6694,
                  'end' => 6701,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6705,
            'end' => 6717,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6705,
              'end' => 6710,
            ),
            'value' => 'place',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6712,
              'end' => 6717,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6712,
                'end' => 6717,
              ),
              'value' => 'Place',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6720,
            'end' => 6740,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6720,
              'end' => 6729,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6731,
              'end' => 6740,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6731,
                'end' => 6739,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6731,
                  'end' => 6739,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6743,
            'end' => 6763,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6743,
              'end' => 6752,
            ),
            'value' => 'updatedAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 6754,
              'end' => 6763,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6754,
                'end' => 6762,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6754,
                  'end' => 6762,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 6563,
          'end' => 6596,
        ),
        'value' => 'Class TapeUserHistoryDetail',
        'block' => true,
      ),
    ),
    44 => 
    array (
      'kind' => 'InputObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 6767,
        'end' => 6944,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6807,
          'end' => 6840,
        ),
        'value' => 'TapeUserHistoryDetailPartialInput',
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 6845,
            'end' => 6861,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6845,
              'end' => 6852,
            ),
            'value' => 'visible',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6854,
              'end' => 6861,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6854,
                'end' => 6861,
              ),
              'value' => 'Boolean',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 6864,
            'end' => 6881,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6864,
              'end' => 6872,
            ),
            'value' => 'exported',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6874,
              'end' => 6881,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6874,
                'end' => 6881,
              ),
              'value' => 'Boolean',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 6884,
            'end' => 6898,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6884,
              'end' => 6889,
            ),
            'value' => 'place',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6891,
              'end' => 6898,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6891,
                'end' => 6898,
              ),
              'value' => 'PlaceID',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 6901,
            'end' => 6920,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6901,
              'end' => 6910,
            ),
            'value' => 'createdAt',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6912,
              'end' => 6920,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6912,
                'end' => 6920,
              ),
              'value' => 'DateTime',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 6923,
            'end' => 6942,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6923,
              'end' => 6932,
            ),
            'value' => 'updatedAt',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6934,
              'end' => 6942,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6934,
                'end' => 6942,
              ),
              'value' => 'DateTime',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 6767,
          'end' => 6800,
        ),
        'value' => 'Class TapeUserHistoryDetail',
        'block' => true,
      ),
    ),
    45 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 6946,
        'end' => 7016,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 6951,
          'end' => 6963,
        ),
        'value' => 'TapeUserPage',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6968,
            'end' => 6988,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6968,
              'end' => 6976,
            ),
            'value' => 'elements',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 6978,
              'end' => 6988,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 6979,
                'end' => 6987,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 6979,
                  'end' => 6987,
                ),
                'value' => 'TapeUser',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 6991,
            'end' => 7001,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 6991,
              'end' => 6996,
            ),
            'value' => 'total',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 6998,
              'end' => 7001,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 6998,
                'end' => 7001,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7004,
            'end' => 7014,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7004,
              'end' => 7009,
            ),
            'value' => 'pages',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7011,
              'end' => 7014,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7011,
                'end' => 7014,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
    ),
    46 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7018,
        'end' => 7148,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7049,
          'end' => 7062,
        ),
        'value' => 'TapeUserScore',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7067,
            'end' => 7086,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7067,
              'end' => 7075,
            ),
            'value' => 'tapeUser',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7077,
              'end' => 7086,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7077,
                'end' => 7085,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7077,
                  'end' => 7085,
                ),
                'value' => 'TapeUser',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7089,
            'end' => 7102,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7089,
              'end' => 7094,
            ),
            'value' => 'score',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7096,
              'end' => 7102,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7096,
                'end' => 7101,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7096,
                  'end' => 7101,
                ),
                'value' => 'Float',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7105,
            'end' => 7123,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7105,
              'end' => 7113,
            ),
            'value' => 'exported',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7115,
              'end' => 7123,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7115,
                'end' => 7122,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7115,
                  'end' => 7122,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7126,
            'end' => 7146,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7126,
              'end' => 7135,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7137,
              'end' => 7146,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7137,
                'end' => 7145,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7137,
                  'end' => 7145,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7018,
          'end' => 7043,
        ),
        'value' => 'Class TapeUserScore',
        'block' => true,
      ),
    ),
    47 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7150,
        'end' => 7247,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7182,
          'end' => 7196,
        ),
        'value' => 'TapeUserStatus',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7201,
            'end' => 7222,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7201,
              'end' => 7217,
            ),
            'value' => 'tapeUserStatusId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7219,
              'end' => 7222,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7219,
                'end' => 7221,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7219,
                  'end' => 7221,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7225,
            'end' => 7245,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7225,
              'end' => 7236,
            ),
            'value' => 'description',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7238,
              'end' => 7245,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7238,
                'end' => 7244,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7238,
                  'end' => 7244,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7150,
          'end' => 7176,
        ),
        'value' => 'Class TapeUserStatus',
        'block' => true,
      ),
    ),
    48 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 7249,
        'end' => 7380,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7364,
          'end' => 7380,
        ),
        'value' => 'TapeUserStatusID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7249,
          'end' => 7356,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `TapeUserStatus` is needed',
        'block' => true,
      ),
    ),
    49 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7382,
        'end' => 7531,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7406,
          'end' => 7412,
        ),
        'value' => 'TvShow',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7417,
            'end' => 7435,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7417,
              'end' => 7425,
            ),
            'value' => 'finished',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7427,
              'end' => 7435,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7427,
                'end' => 7434,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7427,
                  'end' => 7434,
                ),
                'value' => 'Boolean',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7438,
            'end' => 7463,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7438,
              'end' => 7446,
            ),
            'value' => 'chapters',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'ListType',
            'loc' => 
            array (
              'start' => 7448,
              'end' => 7463,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7449,
                'end' => 7462,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7449,
                  'end' => 7462,
                ),
                'value' => 'TvShowChapter',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7466,
            'end' => 7492,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7466,
              'end' => 7477,
            ),
            'value' => 'lastChapter',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7479,
              'end' => 7492,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7479,
                'end' => 7492,
              ),
              'value' => 'TvShowChapter',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7495,
            'end' => 7515,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7495,
              'end' => 7504,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7506,
              'end' => 7515,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7506,
                'end' => 7514,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7506,
                  'end' => 7514,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7518,
            'end' => 7529,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7518,
              'end' => 7522,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7524,
              'end' => 7529,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7524,
                'end' => 7528,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7524,
                  'end' => 7528,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7382,
          'end' => 7400,
        ),
        'value' => 'Class TvShow',
        'block' => true,
      ),
    ),
    50 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7533,
        'end' => 7666,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7564,
          'end' => 7577,
        ),
        'value' => 'TvShowChapter',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7582,
            'end' => 7593,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7582,
              'end' => 7588,
            ),
            'value' => 'season',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7590,
              'end' => 7593,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7590,
                'end' => 7593,
              ),
              'value' => 'Int',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7596,
            'end' => 7609,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7596,
              'end' => 7603,
            ),
            'value' => 'chapter',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7605,
              'end' => 7609,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7605,
                'end' => 7608,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7605,
                  'end' => 7608,
                ),
                'value' => 'Int',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7612,
            'end' => 7627,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7612,
              'end' => 7618,
            ),
            'value' => 'tvShow',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7620,
              'end' => 7627,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7620,
                'end' => 7626,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7620,
                  'end' => 7626,
                ),
                'value' => 'TvShow',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7630,
            'end' => 7650,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7630,
              'end' => 7639,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7641,
              'end' => 7650,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7641,
                'end' => 7649,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7641,
                  'end' => 7649,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7653,
            'end' => 7664,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7653,
              'end' => 7657,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7659,
              'end' => 7664,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7659,
                'end' => 7663,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7659,
                  'end' => 7663,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7533,
          'end' => 7558,
        ),
        'value' => 'Class TvShowChapter',
        'block' => true,
      ),
    ),
    51 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 7668,
        'end' => 7783,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7775,
          'end' => 7783,
        ),
        'value' => 'TvShowID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7668,
          'end' => 7767,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `TvShow` is needed',
        'block' => true,
      ),
    ),
    52 => 
    array (
      'kind' => 'InputObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7785,
        'end' => 7889,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7810,
          'end' => 7828,
        ),
        'value' => 'TvShowPartialInput',
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 7833,
            'end' => 7850,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7833,
              'end' => 7841,
            ),
            'value' => 'finished',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7843,
              'end' => 7850,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7843,
                'end' => 7850,
              ),
              'value' => 'Boolean',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 7853,
            'end' => 7872,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7853,
              'end' => 7862,
            ),
            'value' => 'createdAt',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7864,
              'end' => 7872,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7864,
                'end' => 7872,
              ),
              'value' => 'DateTime',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'InputValueDefinition',
          'loc' => 
          array (
            'start' => 7875,
            'end' => 7887,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7875,
              'end' => 7879,
            ),
            'value' => 'tape',
          ),
          'type' => 
          array (
            'kind' => 'NamedType',
            'loc' => 
            array (
              'start' => 7881,
              'end' => 7887,
            ),
            'name' => 
            array (
              'kind' => 'Name',
              'loc' => 
              array (
                'start' => 7881,
                'end' => 7887,
              ),
              'value' => 'TapeID',
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7785,
          'end' => 7803,
        ),
        'value' => 'Class TvShow',
        'block' => true,
      ),
    ),
    53 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 7891,
        'end' => 8059,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 7913,
          'end' => 7917,
        ),
        'value' => 'User',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7922,
            'end' => 7933,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7922,
              'end' => 7928,
            ),
            'value' => 'userId',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7930,
              'end' => 7933,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7930,
                'end' => 7932,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7930,
                  'end' => 7932,
                ),
                'value' => 'ID',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7936,
            'end' => 7949,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7936,
              'end' => 7940,
            ),
            'value' => 'name',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7942,
              'end' => 7949,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7942,
                'end' => 7948,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7942,
                  'end' => 7948,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7952,
            'end' => 7966,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7952,
              'end' => 7957,
            ),
            'value' => 'email',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7959,
              'end' => 7966,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7959,
                'end' => 7965,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7959,
                  'end' => 7965,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7969,
            'end' => 7986,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7969,
              'end' => 7977,
            ),
            'value' => 'password',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 7979,
              'end' => 7986,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 7979,
                'end' => 7985,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 7979,
                  'end' => 7985,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 7989,
            'end' => 8011,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 7989,
              'end' => 8002,
            ),
            'value' => 'rememberToken',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8004,
              'end' => 8011,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8004,
                'end' => 8010,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8004,
                  'end' => 8010,
                ),
                'value' => 'String',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        5 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8014,
            'end' => 8034,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8014,
              'end' => 8023,
            ),
            'value' => 'createdAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8025,
              'end' => 8034,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8025,
                'end' => 8033,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8025,
                  'end' => 8033,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        6 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8037,
            'end' => 8057,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8037,
              'end' => 8046,
            ),
            'value' => 'updatedAt',
          ),
          'arguments' => 
          array (
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8048,
              'end' => 8057,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8048,
                'end' => 8056,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8048,
                  'end' => 8056,
                ),
                'value' => 'DateTime',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 7891,
          'end' => 7907,
        ),
        'value' => 'Class User',
        'block' => true,
      ),
    ),
    54 => 
    array (
      'kind' => 'ScalarTypeDefinition',
      'loc' => 
      array (
        'start' => 8061,
        'end' => 8172,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 8166,
          'end' => 8172,
        ),
        'value' => 'UserID',
      ),
      'directives' => 
      array (
      ),
      'description' => 
      array (
        'kind' => 'StringValue',
        'loc' => 
        array (
          'start' => 8061,
          'end' => 8158,
        ),
        'value' => 'Automatically generated type to be used as input where an object of type `User` is needed',
        'block' => true,
      ),
    ),
    55 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 8174,
        'end' => 8642,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 8179,
          'end' => 8187,
        ),
        'value' => 'mutation',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8192,
            'end' => 8304,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8192,
              'end' => 8204,
            ),
            'value' => 'editTapeUser',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8205,
                'end' => 8220,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8205,
                  'end' => 8211,
                ),
                'value' => 'userId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8213,
                  'end' => 8220,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8213,
                    'end' => 8219,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8213,
                      'end' => 8219,
                    ),
                    'value' => 'UserID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8222,
                'end' => 8237,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8222,
                  'end' => 8228,
                ),
                'value' => 'tapeId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8230,
                  'end' => 8237,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8230,
                    'end' => 8236,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8230,
                      'end' => 8236,
                    ),
                    'value' => 'TapeID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            2 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8239,
                'end' => 8274,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8239,
                  'end' => 8255,
                ),
                'value' => 'tapeUserStatusId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8257,
                  'end' => 8274,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8257,
                    'end' => 8273,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8257,
                      'end' => 8273,
                    ),
                    'value' => 'TapeUserStatusID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            3 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8276,
                'end' => 8292,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8276,
                  'end' => 8283,
                ),
                'value' => 'placeId',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8285,
                  'end' => 8292,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8285,
                    'end' => 8292,
                  ),
                  'value' => 'PlaceID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8295,
              'end' => 8304,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8295,
                'end' => 8303,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8295,
                  'end' => 8303,
                ),
                'value' => 'TapeUser',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8307,
            'end' => 8470,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8307,
              'end' => 8332,
            ),
            'value' => 'editTapeUserHistoryDetail',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8333,
                'end' => 8348,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8333,
                  'end' => 8339,
                ),
                'value' => 'tapeId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8341,
                  'end' => 8348,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8341,
                    'end' => 8347,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8341,
                      'end' => 8347,
                    ),
                    'value' => 'TapeID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8350,
                'end' => 8365,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8350,
                  'end' => 8356,
                ),
                'value' => 'userId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8358,
                  'end' => 8365,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8358,
                    'end' => 8364,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8358,
                      'end' => 8364,
                    ),
                    'value' => 'UserID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            2 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8367,
                'end' => 8402,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8367,
                  'end' => 8383,
                ),
                'value' => 'tapeUserStatusId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8385,
                  'end' => 8402,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8385,
                    'end' => 8401,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8385,
                      'end' => 8401,
                    ),
                    'value' => 'TapeUserStatusID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            3 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8404,
                'end' => 8445,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8404,
                  'end' => 8409,
                ),
                'value' => 'input',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8411,
                  'end' => 8445,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8411,
                    'end' => 8444,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8411,
                      'end' => 8444,
                    ),
                    'value' => 'TapeUserHistoryDetailPartialInput',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8448,
              'end' => 8470,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8448,
                'end' => 8469,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8448,
                  'end' => 8469,
                ),
                'value' => 'TapeUserHistoryDetail',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8473,
            'end' => 8520,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8473,
              'end' => 8483,
            ),
            'value' => 'editTvShow',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8484,
                'end' => 8510,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8484,
                  'end' => 8489,
                ),
                'value' => 'input',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8491,
                  'end' => 8510,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8491,
                    'end' => 8509,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8491,
                      'end' => 8509,
                    ),
                    'value' => 'TvShowPartialInput',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8513,
              'end' => 8520,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8513,
                'end' => 8519,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8513,
                  'end' => 8519,
                ),
                'value' => 'TvShow',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8523,
            'end' => 8563,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8523,
              'end' => 8538,
            ),
            'value' => 'importImdbMovie',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8539,
                'end' => 8555,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8539,
                  'end' => 8549,
                ),
                'value' => 'imdbNumber',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8551,
                  'end' => 8555,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8551,
                    'end' => 8554,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8551,
                      'end' => 8554,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8558,
              'end' => 8563,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8558,
                'end' => 8562,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8558,
                  'end' => 8562,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        4 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8566,
            'end' => 8640,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8566,
              'end' => 8584,
            ),
            'value' => 'importImdbEpisodes',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8585,
                'end' => 8601,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8585,
                  'end' => 8595,
                ),
                'value' => 'imdbNumber',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8597,
                  'end' => 8601,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8597,
                    'end' => 8600,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8597,
                      'end' => 8600,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8603,
                'end' => 8621,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8603,
                  'end' => 8615,
                ),
                'value' => 'seasonNumber',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8617,
                  'end' => 8621,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8617,
                    'end' => 8620,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8617,
                      'end' => 8620,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8624,
              'end' => 8640,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 8624,
                'end' => 8639,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8625,
                  'end' => 8638,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8625,
                    'end' => 8638,
                  ),
                  'value' => 'TvShowChapter',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
    ),
    56 => 
    array (
      'kind' => 'ObjectTypeDefinition',
      'loc' => 
      array (
        'start' => 8644,
        'end' => 9072,
      ),
      'name' => 
      array (
        'kind' => 'Name',
        'loc' => 
        array (
          'start' => 8649,
          'end' => 8654,
        ),
        'value' => 'query',
      ),
      'interfaces' => 
      array (
      ),
      'directives' => 
      array (
      ),
      'fields' => 
      array (
        0 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8659,
            'end' => 8713,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8659,
              'end' => 8665,
            ),
            'value' => 'search',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8666,
                'end' => 8682,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8666,
                  'end' => 8673,
                ),
                'value' => 'pattern',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8675,
                  'end' => 8682,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8675,
                    'end' => 8681,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8675,
                      'end' => 8681,
                    ),
                    'value' => 'String',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8684,
                'end' => 8696,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8684,
                  'end' => 8691,
                ),
                'value' => 'rowType',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8693,
                  'end' => 8696,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8693,
                    'end' => 8696,
                  ),
                  'value' => 'Int',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8699,
              'end' => 8713,
            ),
            'type' => 
            array (
              'kind' => 'ListType',
              'loc' => 
              array (
                'start' => 8699,
                'end' => 8712,
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8700,
                  'end' => 8711,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8700,
                    'end' => 8711,
                  ),
                  'value' => 'SearchValue',
                ),
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        1 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8716,
            'end' => 8743,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8716,
              'end' => 8720,
            ),
            'value' => 'tape',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8721,
                'end' => 8735,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8721,
                  'end' => 8727,
                ),
                'value' => 'tapeId',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8729,
                  'end' => 8735,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8729,
                    'end' => 8735,
                  ),
                  'value' => 'TapeID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8738,
              'end' => 8743,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8738,
                'end' => 8742,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8738,
                  'end' => 8742,
                ),
                'value' => 'Tape',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        2 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8746,
            'end' => 8928,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8746,
              'end' => 8758,
            ),
            'value' => 'listTapeUser',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8759,
                'end' => 8774,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8759,
                  'end' => 8765,
                ),
                'value' => 'userId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8767,
                  'end' => 8774,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8767,
                    'end' => 8773,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8767,
                      'end' => 8773,
                    ),
                    'value' => 'UserID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8776,
                'end' => 8810,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8776,
                  'end' => 8792,
                ),
                'value' => 'tapeUserStatusId',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8794,
                  'end' => 8810,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8794,
                    'end' => 8810,
                  ),
                  'value' => 'TapeUserStatusID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            2 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8812,
                'end' => 8828,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8812,
                  'end' => 8819,
                ),
                'value' => 'placeId',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8821,
                  'end' => 8828,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8821,
                    'end' => 8828,
                  ),
                  'value' => 'PlaceID',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            3 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8830,
                'end' => 8847,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8830,
                  'end' => 8838,
                ),
                'value' => 'isTvShow',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8840,
                  'end' => 8847,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8840,
                    'end' => 8847,
                  ),
                  'value' => 'Boolean',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            4 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8849,
                'end' => 8865,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8849,
                  'end' => 8856,
                ),
                'value' => 'visible',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8858,
                  'end' => 8865,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8858,
                    'end' => 8865,
                  ),
                  'value' => 'Boolean',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            5 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8867,
                'end' => 8884,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8867,
                  'end' => 8875,
                ),
                'value' => 'finished',
              ),
              'type' => 
              array (
                'kind' => 'NamedType',
                'loc' => 
                array (
                  'start' => 8877,
                  'end' => 8884,
                ),
                'name' => 
                array (
                  'kind' => 'Name',
                  'loc' => 
                  array (
                    'start' => 8877,
                    'end' => 8884,
                  ),
                  'value' => 'Boolean',
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            6 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8886,
                'end' => 8896,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8886,
                  'end' => 8890,
                ),
                'value' => 'page',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8892,
                  'end' => 8896,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8892,
                    'end' => 8895,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8892,
                      'end' => 8895,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            7 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8898,
                'end' => 8912,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8898,
                  'end' => 8906,
                ),
                'value' => 'pageSize',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8908,
                  'end' => 8912,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8908,
                    'end' => 8911,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8908,
                      'end' => 8911,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 8915,
              'end' => 8928,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 8915,
                'end' => 8927,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8915,
                  'end' => 8927,
                ),
                'value' => 'TapeUserPage',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
        3 => 
        array (
          'kind' => 'FieldDefinition',
          'loc' => 
          array (
            'start' => 8931,
            'end' => 9070,
          ),
          'name' => 
          array (
            'kind' => 'Name',
            'loc' => 
            array (
              'start' => 8931,
              'end' => 8952,
            ),
            'value' => 'listTvShowChapterUser',
          ),
          'arguments' => 
          array (
            0 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8953,
                'end' => 8968,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8953,
                  'end' => 8959,
                ),
                'value' => 'userId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8961,
                  'end' => 8968,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8961,
                    'end' => 8967,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8961,
                      'end' => 8967,
                    ),
                    'value' => 'UserID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            1 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8970,
                'end' => 8989,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8970,
                  'end' => 8978,
                ),
                'value' => 'tvShowId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 8980,
                  'end' => 8989,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 8980,
                    'end' => 8988,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 8980,
                      'end' => 8988,
                    ),
                    'value' => 'TvShowID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            2 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 8991,
                'end' => 9026,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 8991,
                  'end' => 9007,
                ),
                'value' => 'tapeUserStatusId',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 9009,
                  'end' => 9026,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 9009,
                    'end' => 9025,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 9009,
                      'end' => 9025,
                    ),
                    'value' => 'TapeUserStatusID',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            3 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 9028,
                'end' => 9038,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 9028,
                  'end' => 9032,
                ),
                'value' => 'page',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 9034,
                  'end' => 9038,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 9034,
                    'end' => 9037,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 9034,
                      'end' => 9037,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
            4 => 
            array (
              'kind' => 'InputValueDefinition',
              'loc' => 
              array (
                'start' => 9040,
                'end' => 9054,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 9040,
                  'end' => 9048,
                ),
                'value' => 'pageSize',
              ),
              'type' => 
              array (
                'kind' => 'NonNullType',
                'loc' => 
                array (
                  'start' => 9050,
                  'end' => 9054,
                ),
                'type' => 
                array (
                  'kind' => 'NamedType',
                  'loc' => 
                  array (
                    'start' => 9050,
                    'end' => 9053,
                  ),
                  'name' => 
                  array (
                    'kind' => 'Name',
                    'loc' => 
                    array (
                      'start' => 9050,
                      'end' => 9053,
                    ),
                    'value' => 'Int',
                  ),
                ),
              ),
              'directives' => 
              array (
              ),
            ),
          ),
          'type' => 
          array (
            'kind' => 'NonNullType',
            'loc' => 
            array (
              'start' => 9057,
              'end' => 9070,
            ),
            'type' => 
            array (
              'kind' => 'NamedType',
              'loc' => 
              array (
                'start' => 9057,
                'end' => 9069,
              ),
              'name' => 
              array (
                'kind' => 'Name',
                'loc' => 
                array (
                  'start' => 9057,
                  'end' => 9069,
                ),
                'value' => 'TapeUserPage',
              ),
            ),
          ),
          'directives' => 
          array (
          ),
        ),
      ),
    ),
  ),
);
