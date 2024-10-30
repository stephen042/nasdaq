<div>
    <form class="m-5" wire:submit.throttle.1000.prevent="bank_withdraw">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="from-group col-12 my-4" id="account-name">
                <label>Account Name: <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="Bank Account Name"></i></label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-control amount" wire:model.blur="account_name" value=""
                    placeholder="Acount Name eg John Shelby Doe">
                @error('account_name')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
            <div class="from-group col-12 my-4" id="account-name">
                <label>Account Number: <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="Bank Account Number"></i></label>
                <input type="text" class="form-control amount" wire:model.blur="account_number" value=""
                    placeholder="Acount Number eg 9908744505">
                @error('account_number')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
            <div class="from-group col-12 my-4" id="account-name">
                <label>Bank Name: <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="Bank Name"></i></label>
                <i class="fas fa-university"></i>
                <input type="text" class="form-control amount" wire:model.blur="bank_name" value=""
                    placeholder="Bank Name eg Chase Bank">
                @error('bank_name')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
            <!-- <div class="rdata"> -->
            <div class="form-group col-12 my-4" id="amount">
                <label>Amount: <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="Funding amount in USD $"></i></label> <i class="fa fa-dollar">
                </i>
                <input type="number" class="form-control amount" wire:model.live="amount" value=""
                    placeholder="Amount to withdraw">
                @error('amount')
                <em class="text-danger">{{ $message }}</em>
                @enderror
                <span class="input-group-text mt-1" id="validatedInputGroupPrepend">
                    <span class="">Current Earnings balance:</span>
                    @if (auth()->user()->earnings_balance <= 100) <span class="text-danger ms-1">
                        <i class="fa fa-dollar"></i>
                        {{ number_format(auth()->user()->earnings_balance, 2) }}
                </span>
                @else
                <span class="text-success ms-1">
                    <i class="fa fa-dollar"></i>
                    {{ number_format(auth()->user()->earnings_balance, 2) }}
                </span>
                @endif
                </span>
            </div>
            <!-- </div> -->

            <div class="form-group col-12 my-4">
                <label for="account_type">
                    Account Type:
                    <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="Account type">
                    </i>
                </label>
                <input type="text" class="form-control" value="" wire:model.blur="account_type"
                    placeholder="Account type eg Savings">
                @error('account_type')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
            <div class="form-group col-12 my-4">
                <label for="full_address">
                    Full Home Address:
                    <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="your full house address">
                    </i>
                </label>
                <input type="text" class="form-control" value="" wire:model.blur="full_address" placeholder="eg 123 Oak Street, Anytown, Birmingham, B12 4DE">
                @error('full_address')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>
            <div class="form-group col-12 my-4">
                <label for="swift_bic_code">
                    SWIFT/BIC Code:
                    <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip"
                        title="swift/bic code">
                    </i>
                </label>
                <input type="text" class="form-control" value="" wire:model.blur="swift_bic_code" placeholder="eg ABNANL2A">
                @error('swift_bic_code')
                <em class="text-danger">{{ $message }}</em>
                @enderror
            </div>

            <div class="form-group col-12 my-4">
                <button wire:loading.attr="disabled" class="login100-form-btn btn-primary col-12" type="submit">
                    Request
                    <x-spinner />
                </button>
            </div>

        </div>
    </form>
</div>