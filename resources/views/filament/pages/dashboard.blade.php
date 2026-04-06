<x-filament-panels::page>

    <!-- TOP ROW -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Total Deals</h2>
            <div style="font-size: 32px; font-weight: bold; color: #111827;">
                {{ $this->totalDeals }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Total Revenue</h2>
            <div style="font-size: 32px; font-weight: bold; color: #111827;">
                ${{ number_format($this->totalRevenue, 2) }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Pipeline Value</h2>
            <div style="font-size: 32px; font-weight: bold; color: #111827;">
                ${{ number_format($this->pipelineValue, 2) }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Renewals Due</h2>
            <div style="font-size: 32px; font-weight: bold; color: #dc2626;">
                {{ $this->renewalsDue }}
            </div>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Paid Payments</h2>
            <div style="font-size: 28px; font-weight: bold; color: #16a34a;">
                {{ $this->paidPayments }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Pending Payments</h2>
            <div style="font-size: 28px; font-weight: bold; color: #f59e0b;">
                {{ $this->pendingPayments }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Upcoming Training</h2>
            <div style="font-size: 28px; font-weight: bold; color: #2563eb;">
                {{ $this->upcomingTraining }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="font-size: 14px; color: #666; margin-bottom: 10px;">Closed Won</h2>
            <div style="font-size: 28px; font-weight: bold; color: #7c3aed;">
                {{ $this->closedWonDeals }}
            </div>
        </div>

    </div>

    <!-- DEALS BY STAGE -->
    <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <h2 style="margin-bottom: 15px; font-size: 18px; font-weight: 600; color: #111827;">Deals by Stage</h2>

        @forelse ($this->dealsByStage as $stage => $count)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee;">
                <span style="color: #374151;">
                    {{ str_replace('_', ' ', ucwords($stage, '_')) }}
                </span>
                <strong style="color: #111827;">{{ $count }}</strong>
            </div>
        @empty
            <div style="color: #6b7280;">No deal data yet.</div>
        @endforelse
    </div>

    <!-- ALERTS -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px;">

        <!-- RENEWALS -->
        <div style="background: white; padding: 20px; border: 1px solid #fecaca; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="margin-bottom: 15px; color: #dc2626; font-size: 18px; font-weight: 600;">
                ⚠️ Renewal Alerts
            </h2>

            @forelse ($this->renewalAlerts as $deal)
                <div style="padding: 12px 0; border-bottom: 1px solid #fee2e2;">
                    <strong style="color: #111827;">{{ $deal->title }}</strong><br>
                    <span style="font-size: 12px; color: #666;">
                        Renewal: {{ optional($deal->renewal_date)->format('m/d/Y') }}
                    </span>
                </div>
            @empty
                <div style="color: #6b7280;">No renewal alerts.</div>
            @endforelse
        </div>

        <!-- PAYMENTS -->
        <div style="background: white; padding: 20px; border: 1px solid #fde68a; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="margin-bottom: 15px; color: #d97706; font-size: 18px; font-weight: 600;">
                💰 Pending Payments
            </h2>

            @forelse ($this->paymentAlerts as $payment)
                <div style="padding: 12px 0; border-bottom: 1px solid #fef3c7;">
                    <strong style="color: #111827;">{{ $payment->deal?->title }}</strong><br>
                    <span style="font-size: 12px; color: #666;">
                        ${{ number_format($payment->amount, 2) }}
                    </span>
                </div>
            @empty
                <div style="color: #6b7280;">No pending payments.</div>
            @endforelse
        </div>

        <!-- TRAINING -->
        <div style="background: white; padding: 20px; border: 1px solid #bfdbfe; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="margin-bottom: 15px; color: #2563eb; font-size: 18px; font-weight: 600;">
                📅 Upcoming Training
            </h2>

            @forelse ($this->trainingAlerts as $training)
                <div style="padding: 12px 0; border-bottom: 1px solid #dbeafe;">
                    <strong style="color: #111827;">{{ $training->title }}</strong><br>
                    <span style="font-size: 12px; color: #666;">
                        {{ \Carbon\Carbon::parse($training->session_date)->format('m/d/Y') }}
                    </span>
                </div>
            @empty
                <div style="color: #6b7280;">No upcoming training.</div>
            @endforelse
        </div>

    </div>

    <!-- RECENT DEALS -->
    <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <h2 style="margin-bottom: 15px; font-size: 18px; font-weight: 600; color: #111827;">Recent Deals</h2>

        @forelse ($this->recentDeals as $deal)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee;">
                <div>
                    <strong style="color: #111827;">{{ $deal->title }}</strong><br>
                    <span style="font-size: 12px; color: #666;">
                        {{ $deal->organization?->name }}{{ $deal->contact ? ' • ' . $deal->contact->name : '' }}
                    </span>
                </div>
                <div style="text-align: right;">
                    <div style="color: #374151;">
                        {{ str_replace('_', ' ', ucwords($deal->stage, '_')) }}
                    </div>
                    <div style="font-size: 12px; color: #666;">
                        ${{ number_format((float) $deal->value, 2) }}
                    </div>
                </div>
            </div>
        @empty
            <div style="color: #6b7280;">No recent deals.</div>
        @endforelse
    </div>

</x-filament-panels::page>