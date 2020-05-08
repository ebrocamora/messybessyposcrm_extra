<?php

return [
    /*
     * Default table attributes when generating the table.
     */
    'table' => [
        'class' => 'responsive table table-sm table-striped table-condensed table-hover',
        'id'    => 'dataTableBuilder',
    ],

    /*
     * Default condition to determine if a parameter is a callback or not.
     * Callbacks needs to start by those terms or they will be casted to string.
     */
    'callback' => ['$', '$.', 'function'],

    /*
     * Html builder script template.
     */
    'script' => 'datatables::script',

    /*
     * Html builder script template for DataTables Editor integration.
     */
    'editor' => 'datatables::editor',

    'dom'=>"<'card-body'<'row' <'col-md-6 col-sm-12'l><'col-md-6 col-sm-12 text-right'B><'col-12 d-md-none d-lg-none'f><'col-md-12' tr><'col-sm-5 col-md-5'i><'col-sm-7 col-md-7'p>>>",

    'action_attributes'=>['data' => 'action', 'name' => 'action','title' => 'Action','render' => null,'orderable' => false,'searchable' => false,'exportable' => false,'printable' => false,'footer' => '','class'=>'text-center text-nowrap'],

    'buttons'=>['reload', 'reset', 'create']
];
