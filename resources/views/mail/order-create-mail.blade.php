<div>
    <h4>order create id :
        {{ $order->id }}
    </h4>
    <h5>รายละเอียด</h5>
    <ul>
        <li>shipping_address : {{ $order->shipping_address }}</li>
        <li>receipt_address : {{ $order->receipt_address }}</li>
        <li>summary_price : {{ $order->summary_price }}</li>
        <li>created_at : {{ $order->created_at }}</li>
        <li>updated_at : {{ $order->updated_at }}</li>
    </ul>

</div>
