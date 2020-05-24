<footer>
    <div class="footer__main">
        <ul class="footer__main-box footer__logo-box">
            <li>
{{--                <img src="{{$model->logo->imageUrl}}"--}}
{{--                     alt="{{$model->logo->htmlTitle}}"--}}
{{--                     title="{{$model->logo->htmlTitle}}">--}}
                <H1>Hiriko Estudio</H1>
            </li>
            <li>
                <h2>{!! $model->logo->slogan !!}</h2>
            </li>
        </ul>
        <ul class="footer__main-box footer__contact-box">
            <li>
                <a href="{{ $model->contacts->address->url }}"
                   class="jgtm-addr"
                   title="{{ $model->contacts->address->title }}"
                   target="_blank">
                    {!! $model->contacts->address->text !!}
                </a>
            </li>
            <li class="content__box">
                <a href="{{ $model->contacts->telephone->url }}"
                   class="jgtm-phone"
                   title="{{ $model->contacts->telephone->title }}">
                    {!! $model->contacts->telephone->text !!}
                </a>
            </li>
            <li class="content__box">
                <a href="{{ $model->contacts->email->url }}"
                   class="jgtm-email"
                   title="{{ $model->contacts->email->title }}"
                   target="_blank">
                    {!! $model->contacts->email->text !!}
                </a>
            </li>
        </ul>
        @if (!empty($model->socials))
            <ul class="footer__main-box footer__social-box">
                @foreach($model->socials as $socialLink)
                    <li>
                        <a href="{{$socialLink->url}}"
                           title="{{$socialLink->text}}"
                           target="_blank">
                            <i class="{{$socialLink->iconClass}}" title="{{$socialLink->text}}"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="footer__sub">
        <section>
                <p>
                    <a href="{{$model->sub->cookiePolicyUrl}}"
                       title="{{$model->sub->cookiePolicyText}}">
                        {{$model->sub->cookiePolicyText}}
                    </a>
                </p>
            <p>
                <a href="{{$model->sub->privacyPolicyUrl}}"
                   title="{{$model->sub->privacyPolicyText}}">
                    {{$model->sub->privacyPolicyText}}
                </a>
            </p>
        </section>
        <section>
            <p>{{$model->sub->appVersion}}</p>
            <p>
                <a href="{{$model->sub->copyrightUrl}}"
                   title="{{$model->sub->copyrightText}}">
                    {{$model->sub->copyrightText}}
                </a>
            </p>
            <p>{{$model->sub->allRightReserved}}</p>
        </section>
    </div>
</footer>
