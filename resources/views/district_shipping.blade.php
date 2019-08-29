<label>Kecamatan <span class="red">*</span></label>
<div class="custom-select">
  <div class="replacement form-control"></div>
  <select class="custom-select form-control" id="shipping_district" name="kecamatan" onChange="custom_select(this)">
    <option value="0" data-reg="0" data-yes="0"></option>
    @foreach($districts as $district)
    <option value="{{ $district->id }}" data-reg="{{$district->reg}}" data-oke="{{(($district->oke==0 ? $district->reg : $district->oke))}}">{{ $district->district_name }}</option>
    @endforeach
  </select>
</div>
<script>
$('#shipping_district').change(function(){
  var val = $('input[name="shipping"]:checked').val();
  if(val==1){
    var value = $('option:selected', this).attr('data-reg');
  }else{
    var value = $('option:selected', this).attr('data-oke');
  }
  $('#shipping_value').html(value);
  calculate_shipping()
});
</script>
