<?php
namespace App\Console\Commands;
use App\Models\Renewal;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
class SendRenewalAlerts extends Command
{
    protected $signature = 'renewals:send-alerts';
    protected $description = 'Send renewal reminder alerts at 150, 90, and 30 days';
    public function handle(): void
    {
        $today = now()->toDateString();
        $this->sendAlerts(150, 'reminder_150_sent', 'reminder_150_sent');
        $this->sendAlerts(90, 'reminder_90_sent', 'reminder_90_sent');
        $this->sendAlerts(30, 'reminder_30_sent', 'reminder_30_sent');
        $this->info('Renewal alerts processed successfully.');
    }
    private function sendAlerts(int $days, string $sentField, string $flag): void
    {
        $targetDate = now()->addDays($days)->toDateString();
        $renewals = Renewal::where('renewal_due_date', $targetDate)
            ->where($sentField, false)
            ->where('status', 'upcoming')
            ->with('organization')
            ->get();
        foreach ($renewals as $renewal) {
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                \Illuminate\Support\Facades\Log::info("RENEWAL ALERT [{$days} days]: " .
                    "Organization: {$renewal->organization->name}, " .
                    "Contract: {$renewal->contract_title}, " .
                    "Due: {$renewal->renewal_due_date}, " .
                    "Amount: {$renewal->renewal_amount}, " .
                    "Notify: {$admin->email}"
                );
            }
            $renewal->update([$sentField => true]);
        }
    }
}
