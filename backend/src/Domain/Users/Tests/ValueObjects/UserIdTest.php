<?php

namespace App\Domain\Users\Tests\ValueObjects;

use App\Domain\Users\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function test_generate_creates_valid_uuid(): void
    {
        $id = UserId::generate();

        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $id->value,
        );
    }

    public function test_generate_creates_unique_ids(): void
    {
        $a = UserId::generate();
        $b = UserId::generate();

        $this->assertNotSame($a->value, $b->value);
    }

    public function test_from_preserves_value(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';

        $id = UserId::from($uuid);

        $this->assertSame($uuid, $id->value);
    }

    public function test_create_preserves_value(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';

        $id = UserId::create($uuid);

        $this->assertSame($uuid, $id->value);
    }

    public function test_from_and_create_produce_same_result(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';

        $this->assertSame(UserId::from($uuid)->value, UserId::create($uuid)->value);
    }
}
