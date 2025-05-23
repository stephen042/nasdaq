<div class="card-body">
    <div class="row">
        @forelse ($signal_plans as $key => $data)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-3" wire:key="{{$key}}">
                <div class="card">
                    <form wire:submit.throttle.1000.prevent="signal_plans({{$data->id}})">
                        @csrf
                        <div class="card-header">
                            <div class="card-title">{{ $data->name }}</div>
                        </div>
                        <div class="card-body">
                            <h4>Amount : ${{ number_format($data->amount, 2) }}</h4>

                            <h4>Duration : {{ $data->duration }}</h4>

                            <h4>Signal strength : {{ $data->signal_strength }}%</h4>

                            <button class="login100-form-btn btn-primary please-wait-btn col-10"
                                type="submit"
                            >
                                Purchase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <h2>No Plans Available</h2>
        @endforelse

    </div>
</div>
