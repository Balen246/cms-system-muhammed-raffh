<div class="social-links text-center text-md-right pt-3 pt-md-0">
    @php
        $socialLinks = Helper::getSocialLinks();
    @endphp
    
    @if($socialLinks->count() > 0)
        @foreach($socialLinks as $socialLink)
            <a href="{{ $socialLink->url }}" 
               data-bs-toggle="tooltip" 
               title="{{ $socialLink->name }}" 
               data-bs-placement="{{ @$tt_position }}"
               target="_blank" 
               class="social-{{ strtolower(str_replace(' ', '-', $socialLink->name)) }}">
                <i class="{{ $socialLink->icon_class }}"></i>
            </a>
        @endforeach
    @else
        {{-- Fallback to old static social links if no dynamic links exist --}}
        @if(Helper::GeneralSiteSettings('social_link1'))
            <a href="{{Helper::GeneralSiteSettings('social_link1')}}" data-bs-toggle="tooltip" title="Facebook" data-bs-placement="{{ @$tt_position }}"
               target="_blank" class="social-facebook"><i
                    class="bi bi-facebook"></i></a>
        @endif

        @if(Helper::GeneralSiteSettings('social_link4'))
            <a href="{{Helper::GeneralSiteSettings('social_link4')}}" data-bs-toggle="tooltip" title="linkedin" data-bs-placement="{{ @$tt_position }}"
               target="_blank" class="social-linkedin"><i
                    class="bi bi-linkedin"></i></a>
        @endif

        @if(Helper::GeneralSiteSettings('social_link5'))
            <a href="{{Helper::GeneralSiteSettings('social_link5')}}" data-bs-toggle="tooltip" title="Youtube" data-bs-placement="{{ @$tt_position }}"
               target="_blank" class="social-youtube"><i
                    class="bi bi-youtube"></i></a>
        @endif

        @if(Helper::GeneralSiteSettings('social_link6'))
            <a href="{{Helper::GeneralSiteSettings('social_link6')}}" data-bs-toggle="tooltip" title="Instagram" data-bs-placement="{{ @$tt_position }}"
               target="_blank" class="social-instagram"><i
                    class="bi bi-instagram"></i></a>
        @endif

        @if(Helper::GeneralSiteSettings('social_link9'))
            <a href="{{Helper::GeneralSiteSettings('social_link9')}}" data-bs-toggle="tooltip" title="Snapchat" data-bs-placement="{{ @$tt_position }}"
               target="_blank" class="social-snapchat"><i
                    class="bi bi-snapchat"></i></a>
        @endif
    @endif
</div>
