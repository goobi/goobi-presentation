<?php
/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

// Define metadata elements.
// @see http://dfg-viewer.de/en/profile-of-the-metadata/
$metadata = [
    'type' => [
        'format' => [],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 1,
        'index_indexed' => 0,
        'index_boost' => 1.00,
        'is_sortable' => 1,
        'is_facet' => 1,
        'is_listed' => 1,
        'index_autocomplete' => 0,
    ],
    'title' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => 'concat(./mods:titleInfo/mods:nonSort," ",./mods:titleInfo/mods:title)',
                'xpath_sorting' => './mods:titleInfo/mods:title',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:head/teihdr:note[@type="caption"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => "key.wrap = <dt class=\"tx-dlf-metadata-title\">|</dt>\nvalue.required = 1\nvalue.wrap = <dd class=\"tx-dlf-metadata-title\">|</dd>",
        'index_tokenized' => 1,
        'index_stored' => 1,
        'index_indexed' => 1,
        'index_boost' => 2.00,
        'is_sortable' => 1,
        'is_facet' => 0,
        'is_listed' => 1,
        'index_autocomplete' => 1,
    ],
    'volume' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:part/mods:detail/mods:number',
                'xpath_sorting' => './mods:part[@type="host"]/@order',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 1,
        'index_indexed' => 0,
        'index_boost' => 1.00,
        'is_sortable' => 1,
        'is_facet' => 0,
        'is_listed' => 1,
        'index_autocomplete' => 0,
    ],
    'author' => [
        'format' => [
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:head/teihdr:name',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 1,
        'index_stored' => 1,
        'index_indexed' => 1,
        'index_boost' => 2.00,
        'is_sortable' => 1,
        'is_facet' => 1,
        'is_listed' => 1,
        'index_autocomplete' => 1,
    ],
    'place' => [
        'format' => [
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:head/teihdr:origPlace',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 1,
        'index_stored' => 1,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 1,
        'is_facet' => 1,
        'is_listed' => 1,
        'index_autocomplete' => 0,
    ],
    'year' => [
        'format' => [
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:head/teihdr:origDate',
                'xpath_sorting' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:head/teihdr:origDate/@when',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 1,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 1,
        'is_facet' => 1,
        'is_listed' => 1,
        'index_autocomplete' => 0,
    ],
    'language' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:language/mods:languageTerm',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 1,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'collection' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:classification',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:sourceDesc/teihdr:msDesc/teihdr:msIdentifier/teihdr:collection',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 1,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 1,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'owner' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:name[./mods:role/mods:roleTerm="own"]/mods:displayForm',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:publisher',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 1,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'purl' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:identifier[@type="purl"]',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="purl"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.setContentToCurrent = 1\nvalue.typolink.parameter.current = 1\nvalue.wrap = <dd>|</dd>",
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 0,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'urn' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:identifier[@type="urn"]',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="urn"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => "key.wrap = <dt>|</dt>\nvalue.required = 1\nvalue.setContentToCurrent = 1\nvalue.typolink.parameter.current = 1\nvalue.typolink.parameter.prepend = TEXT\nvalue.typolink.parameter.prepend.value = http://nbn-resolving.de/\nvalue.wrap = <dd>|</dd>",
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'opac_id' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:identifier[@type="opac"]',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="opac"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'union_id' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:identifier[@type="ppn"]',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="mmid"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'record_id' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:recordInfo/mods:recordIdentifier',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="recordIdentifier"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 1,
        'index_boost' => 1.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ],
    'prod_id' => [
        'format' => [
            [
                'encoded' => 1,
                'xpath' => './mods:identifier[@type="kitodo"]',
                'xpath_sorting' => '',
            ],
            [
                'encoded' => 2,
                'xpath' => './teihdr:fileDesc/teihdr:publicationStmt/teihdr:idno[@type="kitodo"]',
                'xpath_sorting' => '',
            ],
        ],
        'default_value' => '',
        'wrap' => '',
        'index_tokenized' => 0,
        'index_stored' => 0,
        'index_indexed' => 0,
        'index_boost' => 0.00,
        'is_sortable' => 0,
        'is_facet' => 0,
        'is_listed' => 0,
        'index_autocomplete' => 0,
    ]
];
