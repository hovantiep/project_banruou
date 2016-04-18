<div id="categorymenu">
    <nav class="subnav">

        <ul class="nav-pills categorymenu">
            <li><a class="" href="{{ url('/') }}">Home</a></li>
            <?php
            $level_0 = DB::table('cates')->where('parent_id', 0)->get();
            ?>
            @foreach($level_0 as $item_0)
                <li><a href="#">{{ $item_0->name }}</a>
                    <?php
                    $level_1 = DB::table('cates')->where('parent_id', $item_0->id)->get();
                    ?>
                    @if(!empty($level_1))
                        <div>
                            <ul>
                                @foreach($level_1 as $item_1)
                                    <li>
                                        <a href="{{ route('loaiSanPham',[$item_1->id,$item_1->alias]) }}">{{ $item_1->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
</div>