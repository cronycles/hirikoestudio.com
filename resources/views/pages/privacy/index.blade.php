@extends('layouts.page')
@section('page_content')

    <div class="page__section">
        @if($model->title != null && !empty($model->title))
            <div class="page__title">
                <h1>{{$model->title}}</h1>
            </div>
            <p>
                {{config('custom.company.name')}}, como responsable de ficheros de los que es propietaria, se compromete
                a respetar la confidencialidad de la información de carácter personal de sus clientes, proveedores y
                personal, guardando en todo momento el deber de secreto profesional.
            </p>
            <p>
                {{config('custom.company.name')}} le informa de que se encuentra adaptada a la Ley Orgánica 15/1.999, de
                Protección de Datos de Carácter Personal, y el Real Decreto 1720/2007 por el que se aprueba el
                Reglamento de desarrollo de la L.O.P.D., que sus ficheros con datos personales han sido debidamente
                inscritos en la Agencia Española de Protección de Datos y que cumple con el resto de las obligaciones
                establecidas en la normativa sobre protección de datos para garantizar la confidencialidad y seguridad
                de la información de que dispone.
            </p>
            <p>
                La recogida y tratamiento de los datos personales tiene como finalidad la gestión de nuestros clientes,
                la prestación, suministro, ejecución de los servicios, productos y/o proyectos contratados así como el
                envío de comunicaciones sobre noticias e información sobre novedades y futuros eventos.
            </p>
            <p>
                Los datos personales proporcionados en ningún caso serán cedidos a terceros salvo previo consentimiento
                de los interesados.
            </p>
            <p>
                Por todo ello, {{config('custom.company.name')}}, ha adoptado los niveles de seguridad de protección de
                datos
                personales legalmente requeridos, y ha instalado todos los medios y medidas técnicas a su alcance para
                evitar la pérdida, mal uso, alteración, acceso no autorizado y robo de los datos que le han sido
                confiados.
            </p>
            <p>
                Los titulares de los datos tienen reconocidos y podrán ejercitar los derechos de acceso, cancelación,
                rectificación y oposición, contactando con
            </p>
            <ul style="list-style-type: none">
                <li>
                    {{config('custom.company.name')}}
                </li>
                <li>
                    {{config('custom.company.altAddress')}}
                </li>
                <li>
                    {{config('custom.company.telephone-txt')}}
                </li>
                <li>
                    {{config('custom.company.email')}}
                </li>
            </ul>
        @endif
    </div>
    <div class="page__section">
        <h2>Aviso Legal LSSI-CE</h2>
        <p>
            En cumplimiento de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de
            Comercio Electrónico (LSSI-CE), la empresa {{config('custom.company.name')}}, de acuerdo con el artículo
            10 de la citada Ley, informa de los siguientes datos:
        </p>
        <ul>
            <li>El titular de este sitio web es: {{config('custom.company.owner')}}</li>
            <li>Domicilio Social: {{config('custom.company.altAddress')}}</li>
            <li>Teléfono: (+34) {{config('custom.company.telephone-txt')}}</li>
            <li>Email: {{config('custom.company.email')}}</li>
            <li>Web: www.hirikoestudio.com</li>
        </ul>
    </div>
@endsection

