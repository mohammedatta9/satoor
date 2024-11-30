<div class="modal-header">
    <h5 class="modal-title"> الطلب رقم: {{ $order->number }}</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form class="orderForm" data-id="{{ $order->id }}">
    @csrf
    <div class="modal-body">

        <div class="row">
            <div class="form-group col-6">
                <label>{{ __('dash.nots') }} </label>
                <textarea name="refunded" id="" cols="30" rows="4" class="form-control ">
            {{ old('description', $order->nots) }}</textarea>
                <span class="error-nots text-danger"></span>

            </div>
            <div class="form-group col-6">
                <label>{{ __('dash.Status Shipping') }}</label>
                <select name="status" class="form-control select2" id="status" required>
                    <option value="pending" @if ($order->status == 'pending') selected @endif>{{ __('dash.pending') }}
                    </option>

                    <option value="processing" @if ($order->status == 'processing') selected @endif>
                        {{ __('dash.Select processing') }}</option>

                    <option value="delivering" @if ($order->status == 'delivering') selected @endif>
                        {{ __('dash.Select delivering') }}</option>

                    <option value="completed" @if ($order->status == 'completed') selected @endif>
                        {{ __('dash.Select completed') }}</option>

                    <option value="cancelled" @if ($order->status == 'cancelled') selected @endif>
                        {{ __('dash.Select cancelled') }}</option>

                    <option value="refunded" @if ($order->status == 'refunded') selected @endif>
                        {{ __('dash.Select refunded') }}</option>
                </select>
                <span class="error-status text-danger"></span>

            </div>

            <div class="form-group col-6">
                <label>{{ __('dash.Address') }} </label>
                <input type="text" id="address" class="form-control" name="address"
                    value="{{ old('address', $order->address) }}" maxlength="200">
                <span class="error-address text-danger"></span>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('dash.Update') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('dash.Close') }}</button>
    </div>
</form>
