@php(
    $townshipModel=App\Modules\City\Controllers\TownshipController::TownshipLink()
)

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSix">
        <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
               href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                {{ $townshipModel[2]->name }}
            </a>
        </h4>

    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel"aria-labelledby="headingSix">
        <div class="panel-body">
            <ul class="pading-right4">
                @foreach($townshipModel[0] as $key => $value)
                    <li>
                        <div class="dropdown">
                            <div id="myDropdownTownship{{$key+1}}" class="dropdown-content">
                                <button onclick="myFunctionTownship{{$key+1}}()" class="dropbtn"></button>

                                <a href="{{ route('TownshipNews',['alias' => $value->alias, 'id' => 1]) }}">{{ $value->name }}</a>

                                <ul>
                                    @foreach($townshipModel[1] as $key2 => $value2)
                                        @if($value->id == $value2->township_id)
                                            <li style="list-style: none;">
                                                <a href="{{ route('CityNews',['id' => $value2->id]) }}">{{ $value2->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                    <script>
                        function myFunctionTownship{{$key+1}}() {
                            document.getElementById("myDropdownTownship{{$key+1}}").classList.toggle("show");
                        }
                    </script>
                @endforeach
            </ul>
        </div>
    </div>
</div>