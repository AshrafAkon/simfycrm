<div class="list-group">
    @foreach($customers as $customer)

    <a href="#" onclick="myFunction(this)" id="selected-customer" class="list-group-item list-group-item-action flex-column align-items-start active">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{
                $customer->name}}</h5>
        </div>
        <p class="mb-1">Phone: {{$customer->phone}}</p>
        <!-- <button type="button" class="close">
            <span>×</span>
        </button> -->
    </a>
    @endforeach </div>