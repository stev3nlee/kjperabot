<label>Kecamatan <span class="red">*</span></label>
<div class="custom-select">
  <div class="replacement form-control">{{ $districts[0]->district_name }}</div>
  <select class="custom-select form-control" onchange="custom_select(this)" name="kecamatan">
    @foreach($districts as $district)
    <option value="{{$district->id}}" >{{ $district->district_name }}</option>
    @endforeach
  </select>
</div>
