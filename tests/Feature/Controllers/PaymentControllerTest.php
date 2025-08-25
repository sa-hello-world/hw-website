<?php

namespace Tests\Feature\Controllers;

use App\Data\PaymentMeta;
use App\Enums\MembershipType;
use App\Enums\PaymentStatus;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $member;
    private User $chair;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('app:sync-permissions');
        $schoolYear = SchoolYear::factory()->create();

        $this->user = User::factory()->create();
        $this->member = User::factory()->create();
        $this->chair = User::factory()->create();
        $this->chair->assignRole('chairman');
        $this->actingAs($this->user);

        Membership::create([
            'user_id' => $this->member->id,
            'school_year_id' => $schoolYear->id,
        ]);
    }

    #[Test]
    public function test_store_for_membership_creates_payment_and_redirects(): void
    {
        $schoolYear = SchoolYear::current();

        $response = $this->post(route('payments.store.membership', ['membershipType' => MembershipType::REGULAR->value]));

        $response->assertRedirect();
        $this->assertDatabaseHas('payments', [
            'user_id' => $this->user->id,
            'description' => "Membership contribution for academic year {$schoolYear->years}",
        ]);
    }

    #[Test]
    public function test_store_for_membership_403s_for_unauthorized_user(): void
    {
        $response = $this->actingAs($this->member)
            ->post(route('payments.store.membership', ['membershipType' => MembershipType::REGULAR->value]));

        $response->assertForbidden();
    }

    #[Test]
    public function test_show_payment_view_membership_for_creator(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->user)
            ->get(route('payments.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payments.show');
        $response->assertViewHas('payment', $payment);
    }

    #[Test]
    public function test_show_payment_view_membership_for_chair(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->chair)
            ->get(route('payments.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payments.show');
        $response->assertViewHas('payment', $payment);
    }

    #[Test]
    public function test_show_payment_view_returns_403_when_not_creator(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->member)
            ->get(route('payments.show', $payment));

        $response->assertForbidden();
    }

    public function test_cancel_payment_deletes_the_pending_payment_for_creator(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->status = PaymentStatus::PENDING->value;
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->user)
            ->post(route('payments.cancel', $payment));

        $response->assertRedirect();
        $this->assertDatabaseMissing('payments', ['id' => $payment->id]);
    }

    public function test_cancel_payment_for_chair_returns_403(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->status = PaymentStatus::PENDING->value;
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->chair)
            ->post(route('payments.cancel', $payment));

        $response->assertForbidden();
    }

    public function test_cancel_payment_for_anyone_else_except_creator_returns_403(): void
    {
        $current = SchoolYear::current();

        $payment = Payment::create([
            'user_id' => $this->user->id,
            'amount' => $current->regular_membership_price,
            'description' => 'Lorem ipsum dolar sit amet',
        ]);
        $meta = new PaymentMeta(
            $current->id,
            'membership',
            MembershipType::REGULAR->value
        );
        $payment->status = PaymentStatus::PENDING->value;
        $payment->meta = $meta;
        $payment->save();

        $response = $this->actingAs($this->member)
            ->post(route('payments.cancel', $payment));

        $response->assertForbidden();
    }
}
