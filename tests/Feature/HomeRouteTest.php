<?php

test('home page renders', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Get Started');
});

test('welcome page renders', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Welcome');
});
