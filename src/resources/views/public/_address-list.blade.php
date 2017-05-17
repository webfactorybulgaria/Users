@foreach($addresses as $address)
<div class="row">
    {{$address->first_name}} {{$address->last_name}}<br>
    {{$address->address}}<br>
    {{$address->address2}}<br>
    {{$address->city}} {{$address->state}} {{$address->postcode}}<br>
    {{$address->country}}<br>
    {{$address->phone}}<br>
    last updated: {{$address->updated_at}}<br>
    <a href="{{ route('editAddress-profile', $address->id) }}">Edit</a>
</div>
<hr>
@endforeach