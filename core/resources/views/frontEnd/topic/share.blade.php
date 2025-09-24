<div class="bottom-article mb-3">
    <div class="d-flex justify-content-between">
        <div class="share-title text-muted d-flex"><i class="fa-solid fa-square-share-nodes"></i>  {{ __('frontend.share') }}</div>
        <ul class="social-network share d-flex">
            @php
                $socialLinks = Helper::getSocialLinks();
            @endphp
            
            @if($socialLinks->count() > 0)
                @foreach($socialLinks as $socialLink)
                    <li>
                        <a href="{{ Helper::SocialShare(strtolower($socialLink->name), @$PageTitle) }}"
                           class="{{ strtolower(str_replace(' ', '-', $socialLink->name)) }}"
                           data-bs-toggle="tooltip"
                           title="{{ $socialLink->name }}" 
                           target="_blank">
                            <i class="{{ $socialLink->icon_class }}"></i>
                        </a>
                    </li>
                @endforeach
            @else
                {{-- Fallback to old static social links if no dynamic links exist --}}
                <li><a href="{{ Helper::SocialShare("facebook", @$PageTitle)}}"
                       class="facebook"
                       data-bs-toggle="tooltip"
                       title="Facebook" target="_blank"><i
                            class="fa-brands fa-facebook"></i></a>
                </li>
                <li><a href="{{ Helper::SocialShare("whatsapp", @$PageTitle)}}"
                       class="twitter"
                       data-bs-toggle="tooltip" title="Whatsapp"
                       style="background-color:#067f4b "
                       target="_blank"><i
                            class="fa-brands fa-whatsapp"></i></a></li>
                <li><a href="{{ Helper::SocialShare("twitter", @$PageTitle)}}"
                       class="twitter"
                       data-bs-toggle="tooltip" title="Twitter"
                       target="_blank"><i
                            class="bi bi-twitter-x"></i></a></li>
                <li><a href="{{ Helper::SocialShare("linkedin", @$PageTitle)}}"
                       class="linkedin"
                       data-bs-toggle="tooltip" title="linkedin"
                       target="_blank"><i
                            class="fa-brands fa-linkedin"></i></a></li>
                <li><a href="{{ Helper::SocialShare("tumblr", @$PageTitle)}}" class="tumblr"
                       data-bs-toggle="tooltip" title="Tumblr"
                       target="_blank"><i
                            class="fa-brands fa-tumblr"></i></a></li>
            @endif
        </ul>
    </div>
</div>
