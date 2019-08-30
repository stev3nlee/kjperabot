<label>Kecamatan <span class="red">*</span></label>
<div class="custom-select">
  <div class="replacement form-control"></div>
  <select class="custom-select form-control" name="kecamatan_billing" onChange="custom_select(this)">
    <option value="0" data-reg="0" data-yes="0"></option>
    @foreach($districts as $district)
    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
    @endforeach
  </select>
</div>
<script>
