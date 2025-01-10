<div class="form-group">
    
    <?php
        print_r(json_decode($companies, true));
    ?>
    <label for="exampleInputEmail1">Company Name</label>
    <select class="form-control" data-key="CompanyId" data="req">
        <option value=""></option>
        
        {{-- @if (count(json_decode($companies, true)) > 0)
            @foreach (json_decode($companies, true) as $company)
                <option value="{{$company['id']}}">{{$company['name']}}</option>
            @endforeach
        @endif --}}
    </select>
</div>