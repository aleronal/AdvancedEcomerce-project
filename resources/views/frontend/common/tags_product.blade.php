@php
    $tag_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tag_es = App\Models\Product::groupBy('product_tags_es')->select('product_tags_es')->get();

@endphp

<div class="sidebar-widget product-tag wow fadeInUp">

<h3 class="section-title">
        @if(session()->get('language') == 'spanish')
        Etiquetas de Productos
        @else
        Product Tags
      @endif
</h3>

<div class="sidebar-widget-body outer-top-xs">
    <div class="tag-list"> 
            @if(session()->get('language') == 'spanish')
            @foreach ($tag_es as $tag)

            <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_es) }}">
                {{ str_replace(',',' ',$tag->product_tags_es) }}</a> 
            @endforeach

                @else

            @foreach ($tag_en as $tag)

            <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_en) }}">{{$tag->product_tags_en}}</a> 

            @endforeach
          @endif

        
        
    
    </div>
      <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 