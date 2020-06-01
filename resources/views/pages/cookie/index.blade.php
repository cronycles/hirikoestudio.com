@extends('layouts.page')
@section('page_content')

    <div class="page__section">
        @if($model->title != null && !empty($model->title))
            <div class="page__title">
                <h1>{{$model->title}}</h1>
            </div>
            <p>
                {{config('custom.company.name')}} ha desarrollado esta política para informarte de qué es una cookie.
                Con tu primera visita a nuestra web estás siendo informado de la existencia de cookies y de la presente
                política de cookies. En futuras visitas puedes consultar nuestra política en cualquier momento
                directamente desde el footer, haciendo clic en el link "{{__('footer.cookie-policy-text')}}".
                Con tu registro en la web y/o la mera navegación estás consintiendo la instalación de las cookies
                (salvo que hayas modificado la configuración de tu navegador para rechazar cookies).
            </p>
        @endif
    </div>
    <div class="page__section">
        <h2>¿QUÉ ES UNA COOKIE?</h2>
        <p>
            Una “Cookie” es un pequeño archivo de texto que un sitio web almacena en el navegador del usuario. Las
            cookies facilitan el uso y la navegación de una página web y son esenciales para el funcionamiento de
            internet, aportando innumerables ventajas en la prestación de servicios interactivos.
        </p>
        <p>
            Las cookies se utilizan por ejemplo para gestionar la sesión del usuario (reduciendo el número de veces que
            tiene que incluir su contraseña) o para adecuar los contenidos de una página web a sus preferencias. Las
            cookies pueden ser de “sesión”, por lo que se borrarán una vez el usuario abandone la página web que las
            generó o “persistentes”, que permanecen en su ordenador hasta una fecha determinada.
        </p>
        <p>
            Este documento de “Uso de Cookies” ha sido elaborado a partir de un auditor técnico externo estando, por
            tanto, sujeto a actualizaciones periódicas. Su propósito es ayudarle a comprender el uso que la presente
            página web hace de las cookies, la finalidad de las cookies utilizadas, así como de las opciones que el
            usuario tiene a su disposición para gestionarlas.
        </p>
        <p>
            El uso de esta web con la funcionalidad del navegador habilitada para aceptar cookies, implica la aceptación
            por parte del usuario de la tecnología cookie utilizada por dicha web.
        </p>
    </div>

    <div class="page__section">
        <h2>TIPOS DE COOKIES</h2>
        <p>
            Estos son los tipos de cookies que usamos en nuestra web.
        </p>
        <h3> COOKIES DE USO INTERNO</h3>
        <p>
            Esta web utiliza cookies de uso interno imprescindibles para el funcionamiento de la web, como por ejemplo
            aquellas que permiten la autentificación o el mantenimiento de la sesión del usuario registrado cuando
            navega por la página. La desactivación de estas cookies impide el funcionamiento correcto de algunas de las
            funcionalidades de la web.
        </p>
        <h3> COOKIES ANALÍTICAS</h3>
        <p>
            Esta web utiliza cookies analíticas para recabar estadísticas sobre la actividad del usuario en la web y la
            actividad general de la misma. La información recopilada es anónima y permite optimizar la navegación de
            nuestra página web y garantizar el mejor servicio al usuario. El usuario puede excluir su actividad mediante
            los sistemas de exclusión facilitados por su navegador. En particular, este sitio web utiliza Google
            Analytics, un servicio analítico de web prestado por Google, Inc. con domicilio en los Estados Unidos con
            sede central en 1600 Amphitheatre Parkway, Mountain View, California 94043.
        </p>
    </div>
    <div class="page__section">
        <h2>PERMITIR, BLOQUEAR O ELIMINAR COOKIES</h2>
        <p>
            Puedes permitir, bloquear o eliminar las cookies instaladas en tu equipo mediante la configuración del
            navegador.
        </p>
        <ul>
            <li>
                <a href="https://support.google.com/chrome/answer/95647?hl=es">
                    Chrome
                </a>
            </li>
            <li>
                <a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies">
                    Microsoft Edge
                </a>
            </li>
            <li>
                <a href="https://support.mozilla.org/es/kb/Deshabilitar%20cookies%20de%20terceros">
                    Firefox
                </a>
            </li>
            <li>
                <a href="https://support.apple.com/es-us/guide/safari/sfri11471/mac">
                    Safari
                </a>
            </li>
        </ul>
    </div>
    <div class="page__section">
        <h2>¿DUDAS?</h2>
        <p>
            Si tienes dudas sobre esta política de cookies, puedes contactar con nosotros
            en <a href="mailto:{{config('custom.company.email')}}">{{config('custom.company.email')}}</a>
        </p>
    </div>
@endsection

