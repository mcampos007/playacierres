@extends('layouts.app')

@section('title', 'Terminos y condiciones')

@section('body-class', 'product-page')

@section('content')
    <div class="header header-filter"
        style="background-image: url('{{ asset('img/demofondo.jpg') }}');background-size: cover; background-position: top center;">
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Terminos de Uso </h2>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif

                </div>

                <div class="team">
                    @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:!!</strong>{{ session('msj') }}
                        </div>
                    @endif
                    <div class="row">
                        <h3>Encabezado: Licencias y Términos de Uso</h3>
                        <p>"Entendemos la importancia de la claridad y la transparencia en el uso de nuestras soluciones. A
                            continuación, detallamos las licencias aplicables a nuestros productos y servicios."</p>

                        <h3>1. Introducción</h3>
                        <p>"Esta página describe los términos de las licencias bajo las cuales se ofrecen nuestros
                            productos,
                            servicios y contenido. Al utilizar cualquiera de nuestras soluciones, aceptas cumplir con estas
                            condiciones."</p>

                        <h3>2. Licencia de Uso del Software</h3>
                        <p>Si ofreces software:</p>

                        <p>Derechos de Uso: El software proporcionado está licenciado, no vendido, y se puede utilizar
                            exclusivamente para los fines establecidos en el acuerdo.
                            Restricciones: No está permitido copiar, modificar, redistribuir o descompilar el software sin
                            autorización expresa.</p>
                        <p>Duración: La licencia es válida mientras cumplas con los términos establecidos.</p>
                        <h3>3. Propiedad Intelectual</h3>
                        <p>Todo el contenido, diseño y tecnología utilizada en nuestras soluciones son propiedad de [Nombre
                            de
                            tu Empresa]. No se transfiere ningún derecho de propiedad al usuario.</p>

                        <h3>4. Políticas de Actualización</h3>
                        <p>Si incluyes actualizaciones en tus servicios:</p>

                        <p>Actualizaciones Incluidas: Los usuarios con licencias activas recibirán actualizaciones sin costo
                            adicional.
                            Compatibilidad: Garantizamos que las actualizaciones serán compatibles con versiones recientes
                            de
                            nuestro software.</p>
                        <h3>5. Limitación de Responsabilidad</h3>
                        <p>"No nos hacemos responsables por daños directos, indirectos, incidentales o consecuentes
                            derivados
                            del uso de nuestras soluciones, excepto donde la ley lo exija."</p>

                        <h3>6. Licencias de Terceros</h3>
                        <p>Si utilizas bibliotecas o tecnologías de terceros:</p>

                        <p>"Nuestros productos pueden incluir componentes de terceros licenciados bajo sus propios términos.
                            Consulta la documentación del producto para más detalles."</p>

                        <h3>. Términos Adicionales</h3>
                        <p>Uso Comercial: Las soluciones gratuitas solo se pueden usar para fines no comerciales, a menos
                            que
                            se especifique lo contrario.
                            Cancelación: La empresa se reserva el derecho de cancelar la licencia en caso de incumplimiento.
                        </p>
                        <h3>8. Contacto</h3>
                        <p> <a href="mailto:mcampos@infocam.com.ar">Si tienes dudas sobre las licencias o necesitas
                                asistencia, enviar un correo</a>."

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('includes.footer')
@endsection
