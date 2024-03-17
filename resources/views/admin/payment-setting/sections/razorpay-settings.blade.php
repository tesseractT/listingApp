<div class="tab-pane fade show" id="contact4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.razorpay-settings.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">RazorPay Status <span class="text-danger">*</span></label>
                            <select name="razorpay_status" class="form-control">
                                <option @selected(config('payment.razorpay_status') === 'active') value="active">Active
                                </option>
                                <option @selected(config('payment.razorpay_status') === 'inactive') value="inactive">Inactive
                                </option>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">RazorPay Country</label>
                            <select name="razorpay_country" class="form-control select2">
                                <option value="">Select</option>
                                @foreach (config('countries') as $key => $country)
                                    <option @selected($key === config('payment.razorpay_country')) value="{{ $key }}">
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> RazorPay Currency</label>
                            <select name="razorpay_currency" class="form-control select2">
                                <option value="">Select</option>
                                @foreach (config('currencies.currency_list') as $key => $currency)
                                    <option @selected($currency === config('payment.razorpay_currency')) value="{{ $currency }}">
                                        {{ $key }} ({{ $currency }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">RazorPay Currency Rate (Per
                                {{ config('settings.site_default_currency') }})</label>
                            <input type="text" name="razorpay_currency_rate" class="form-control"
                                value="{{ config('payment.razorpay_currency_rate') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">RazorPay Key</label>
                            <input type="text" name="razorpay_key" class="form-control"
                                value="{{ config('payment.razorpay_key') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">RazorPay Secret Key</label>
                            <input type="text" name="razorpay_secret_key" class="form-control"
                                value="{{ config('payment.razorpay_secret_key') }}">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
