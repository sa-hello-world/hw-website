<?php

namespace Tests\Unit;

use App\Models\Membership;
use App\Models\SchoolYear;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    #[Test]
    public function test_is_member_returns_false_when_no_current_school_year() : void
    {
        $this->assertNull(SchoolYear::current());
        $this->assertFalse($this->user->is_member);
    }

    #[Test]
    public function test_is_member_returns_false_when_no_membership() : void
    {
        SchoolYear::factory()->create();

        $this->assertNotNull(SchoolYear::current());
        $this->assertFalse($this->user->is_member);
    }

    #[Test]
    public function test_is_member_returns_false_when_no_membership_for_current_year() : void
    {
        $prevYear = SchoolYear::create([
            'start_academic_year' => Carbon::now()->subYears(2),
            'end_academic_year' => Carbon::now()->subYear(),
            'name_of_chairman' => 'John Doe',
            'regular_membership_price' => Money::EUR(2000),
            'early_membership_price' => Money::EUR(1000),
            'semester_membership_price' => Money::EUR(1000),
        ]);
        $prevYearMembership = Membership::create([
            'school_year_id' => $prevYear->id,
            'user_id' => $this->user->id,
        ]);

        SchoolYear::factory()->create();

        $this->assertNotNull(SchoolYear::current());
        $this->assertFalse($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($prevYearMembership));
    }

    #[Test]
    public function test_is_member_returns_true_when_current_school_year() : void
    {
        $currentYear = SchoolYear::factory()->create();
        $membership = Membership::create([
            'school_year_id' => $currentYear->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($membership));
    }

    #[Test]
    public function test_is_member_returns_false_when_semester_1_and_membership_for_semester_2() : void
    {
        $currentYear = SchoolYear::factory()->create();
        Carbon::setTestNow(Carbon::parse($currentYear->start_academic_year)->addMonth());

        $membership = Membership::create([
            'school_year_id' => $currentYear->id,
            'user_id' => $this->user->id,
            'semester' => 2
        ]);

        $this->assertFalse($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($membership));
    }

    #[Test]
    public function test_is_member_returns_false_when_semester_2_and_membership_for_semester_1() : void
    {
        $currentYear = SchoolYear::factory()->create();
        Carbon::setTestNow(Carbon::parse($currentYear->start_second_semester)->addMonth());

        $membership = Membership::create([
            'school_year_id' => $currentYear->id,
            'user_id' => $this->user->id,
            'semester' => 1
        ]);

        $this->assertFalse($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($membership));
    }

    #[Test]
    public function test_is_member_returns_true_when_semester_1_and_membership_for_semester_1() : void
    {
        $currentYear = SchoolYear::factory()->create();
        Carbon::setTestNow(Carbon::parse($currentYear->start_academic_year)->addMonth());

        $membership = Membership::create([
            'school_year_id' => $currentYear->id,
            'user_id' => $this->user->id,
            'semester' => 1
        ]);

        $this->assertTrue($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($membership));
    }

    #[Test]
    public function test_is_member_returns_true_when_semester_2_and_membership_for_semester_2() : void
    {
        $currentYear = SchoolYear::factory()->create();
        Carbon::setTestNow(Carbon::parse($currentYear->start_second_semester)->addMonth());

        $membership = Membership::create([
            'school_year_id' => $currentYear->id,
            'user_id' => $this->user->id,
            'semester' => 2
        ]);

        $this->assertTrue($this->user->is_member);
        $this->assertTrue($this->user->memberships->contains($membership));
    }
}
