@foreach($addresses as $address)
<div class="row">
    country: {{$address->country}}<br>
    city: {{$address->city}}<br>
    address: {{$address->address}}<br>
    address2: {{$address->address2}}<br>
    postcode: {{$address->postcode}}<br>
    last updated: {{$address->updated_at}}<br>
    <a href="{{ route('editAddress-profile', $address->id) }}">Edit</a>
</div>
<hr>
@endforeach