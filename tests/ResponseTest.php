<?php

use Pipe\Response;

it("can get class from function", function () {
    expect(response())->toBeInstanceOf(Response::class);
});

it("sets proper headers", function () {
    expect(
        response()->header('Content-Type', 'application/json')->headers
    )->toMatchArray(["Content-Type: application/json" => ["replace" => true, "code" => 0]]);
});

it("sets proper status", function () {
    expect(response()->status(431)->status)->toEqual(431);
});
