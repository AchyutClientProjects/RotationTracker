<?php

declare(strict_types=1);

it('redirects to login page', function (): void {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirect('/login');
});
