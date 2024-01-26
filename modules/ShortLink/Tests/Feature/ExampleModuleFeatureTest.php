<?php

test('example_module_feature', function () {
    $response = $this->get('api/v1/test');

    $response->assertStatus(200);
});
