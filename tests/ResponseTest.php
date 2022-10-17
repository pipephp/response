<?php

use Pipe\Response;

use function Pipe\response;

it("can get class from function", function () {
    expect(response())->toBeInstanceOf(Response::class);
});

it("sets proper headers", function () {
    expect(
        response()->header('Content-Type', 'application/json')->headers
    )->toMatchArray(["Content-Type: application/json" => ["replace" => true, "code" => 0]]);
});
