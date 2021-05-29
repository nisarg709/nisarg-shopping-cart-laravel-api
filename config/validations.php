<?php

return [
    'login' => [
        'rules' => [
            'email' => 'required',
            'password' => 'required',
        ],
        'messages' => [
            'email.required' => 'Email cannot be blank',
            'password.required' => 'Password cannot be blank',
        ],
    ],
    'addEditProduct' => [
        'rules' => [
            'product_name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'price' => 'required',
            'description' => 'required',
        ],
        'messages' => [
            'product_name.required' => 'Product name cannot be blank',
            'category.required' => 'Category cannot be blank',
            'sub_category.required' => 'Sub Category cannot be blank',
            'description.required' => 'Description cannot be blank',
            'price.required' => 'Price cannot be blank',
        ],
    ],
];
