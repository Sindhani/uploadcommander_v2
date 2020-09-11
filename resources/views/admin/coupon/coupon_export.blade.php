<table>
    <thead>
        <tr>
            <th>Coupon</th>
            <th>Type</th>
            <th>Value</th>
            <th>No. Of Coupon</th>
            <th>Package</th>
            <th>Valid From</th>
            <th>Valid To</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($coupons as $coupon)
            <tr>
                <td>{{ $coupon->coupon_code }}</td>
                <td>{{ ucwords($coupon->coupon_type) }}</td>
                <td>{{ ($coupon->coupon_type=='percentage')?$coupon->coupon_value.'%':$coupon->coupon_value.' EURO' }}</td>
                <td>{{ ucwords($coupon->coupon_code_used) }}</td>
                <td>{{ ($coupon->package_id)?$coupon->packages()->first()->subscription_name:'' }}</td>
                <td>{{ $coupon->coupon_from_date }} {{ $coupon->coupon_from_time }}</td>
                <td>{{ $coupon->coupon_to_date }} {{ $coupon->coupon_to_time }}</td>
                <td>{{ $coupon->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>