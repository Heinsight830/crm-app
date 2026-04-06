<x-filament-panels::page>
    <div style="display: flex; gap: 16px; overflow-x: auto; padding: 10px;">

        @foreach ($this->columns as $column)
            <div style="min-width: 260px; background: #f9fafb; border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
                
                <h2 style="font-weight: bold; margin-bottom: 10px;">
                    {{ $column['label'] }}
                </h2>

                @forelse ($column['deals'] as $deal)
                    <div style="background: white; padding: 10px; margin-bottom: 10px; border-radius: 8px; border: 1px solid #ccc;">
                        <div style="font-weight: 600;">
                            {{ $deal->title }}
                        </div>

                        <div style="font-size: 12px; color: gray;">
                            {{ $deal->organization?->name }}
                        </div>

                        <div style="font-size: 12px; color: #555;">
                            {{ $deal->contact?->name }}
                        </div>

                        @if ($deal->value)
                            <div style="margin-top: 5px; font-weight: bold;">
                                ${{ number_format($deal->value, 2) }}
                            </div>
                        @endif

                        <div style="margin-top: 10px;">
                            <form method="POST" action="{{ route('deal.stage.update', $deal->id) }}">
                                @csrf
                                <select name="stage" onchange="this.form.submit()" style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 6px;">
                                    <option value="new_lead" @selected($deal->stage === 'new_lead')>New Lead</option>
                                    <option value="qualified" @selected($deal->stage === 'qualified')>Qualified</option>
                                    <option value="proposal_sent" @selected($deal->stage === 'proposal_sent')>Proposal Sent</option>
                                    <option value="contract_sent" @selected($deal->stage === 'contract_sent')>Contract Sent</option>
                                    <option value="payment_pending" @selected($deal->stage === 'payment_pending')>Payment Pending</option>
                                    <option value="training_scheduled" @selected($deal->stage === 'training_scheduled')>Training Scheduled</option>
                                    <option value="active" @selected($deal->stage === 'active')>Active</option>
                                    <option value="renewal_due" @selected($deal->stage === 'renewal_due')>Renewal Due</option>
                                    <option value="closed_won" @selected($deal->stage === 'closed_won')>Closed Won</option>
                                    <option value="closed_lost" @selected($deal->stage === 'closed_lost')>Closed Lost</option>
                                </select>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="font-size: 12px; color: #999;">
                        No deals
                    </div>
                @endforelse

            </div>
        @endforeach

    </div>
</x-filament-panels::page>