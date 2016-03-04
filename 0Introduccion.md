# Breve introducción a los conceptos de Frameworks de programación y Aponwao Framework.

# Introducción a los Frameworks PHP #

## Que es un Framework de programación? ##

En el desarrollo de Software, un framework es una estructura de soporte definida en la cual otro proyecto de software puede ser organizado y desarrollado. Típicamente, un framework puede incluir soporte de programas, librerías y un lenguaje de scripting, entre otras herramientas; con el propósito de ayudar a desarrollar y unir los diferentes componentes de un proyecto.

Un framework agrega funcionalidad extendida a un lenguaje de programación; éste, automatiza muchos de los patrones de programación para orientarlos a un determinado propósito. Un framework proporciona una estructura al código y hace que los desarrolladores escriban código mejor, más entendible y mantenible. Así mismo hace que la programación sea más fácil, convirtiendo complejas funciones en sencillas instrucciones. Está usualmente escrito en el lenguaje que extiende. Aponwao está escrito en PHP5.

Un framework permite separar en capas la aplicación. En general, divide la aplicación en tres capas:

  * La lógica de presentación que administra las interacciones entre el usuario y el software.
  * La Lógica de Datos que permite el acceso a un agente de almacenamiento persistente u otros.
  * La lógica de dominio o de negocio, que manipula los modelos de datos de acuerdo a los comandos recibidos desde la presentación.

Los Frameworks para el desarrollo de aplicaciones Web (sitios Web, intranets, etc.) pretenden facilitar el desarrollo tanto en tiempo como en calidad de código y escalabilidad. PHP es conocido por su simplicidad y es ampliamente usado en este campo. Sólo PHP puede utilizar casi cualquier motor de base de datos, administrar sesiones, acceder a archivos del servidor, etc., pero cuando las aplicaciones crecen y su complejidad aumenta un framework solventa muchos problemas y facilita muchas tareas.


## Aponwao como Framework PHP ##

Aponwao es un marco de trabajo (framework) para el desarrollo de aplicaciones Web utilizando el lenguaje de programación PHP en su versión 5,  desarrollado 100% en Venezuela para el mundo entero. Aponwao le permitirá trabajar bajo una arquitectura de multiples capas, utilizar el modelo MVC e integrar sus proyectos mediante Webservices, además contribuye al desarrollo de la industria venezolana del software al proveer herramientas basadas en software libre y open source.

Así mismo persigue ayudar a reducir el tiempo de desarrollo de una aplicación web sin producir efectos sobre los programadores, haciéndolos  más eficientes liberándolos de tareas repetitivas de programación permitiéndoles enfocarse en los objetivos del proyecto.

Aponwao es un framework desarrollado bajo un modelo MVC y orientado a una arquitectura basada en servicios (SOA). Es por ello que a continuación explicaremos dicho modelo y arquitectura, como puntos claves del proyecto.

Aunque se pueden encontrar diferentes implementaciones de MVC, el flujo que sigue el control generalmente es el siguiente:

  1. El usuario interactúa con la interfaz de usuario de alguna forma (por ejemplo, el usuario pulsa un botón, enlace)  El controlador recibe (por parte de los objetos de la interfaz-vista) la notificación de la acción solicitada por el usuario. El controlador gestiona el evento que llega, frecuentemente a través de un gestor de eventos (handler) o callback.
  1. El controlador accede al modelo, actualizándolo, posiblemente modificándolo de forma adecuada a la acción solicitada por el usuario (por ejemplo, el controlador actualiza el carro de la compra del usuario). Los controladores complejos están a menudo estructurados usando un patrón de comando que encapsula las acciones y simplifica su extensión.
  1. El controlador delega a los objetos de la vista la tarea de desplegar la interfaz de usuario. La vista obtiene sus datos del modelo para generar la interfaz apropiada para el usuario donde se refleja los cambios en el modelo (por ejemplo, produce un listado del contenido del carro de la compra).
  1. El modelo no debe tener conocimiento directo sobre la vista. Sin embargo, el patrón de observador puede ser utilizado para proveer cierta indirección entre el modelo y la vista, permitiendo al modelo notificar a los interesados de cualquier cambio.
  1. Un objeto vista puede registrarse con el modelo y esperar a los cambios, pero aun así el modelo en sí mismo sigue sin saber nada de la vista. El controlador no pasa objetos de dominio (el modelo) a la vista aunque puede dar la orden a la vista para que se actualice.
  1. La interfaz de usuario espera nuevas interacciones del usuario, comenzando el ciclo nuevamente.

_Nota: En algunas implementaciones la vista no tiene acceso directo al modelo, dejando que el controlador envíe los datos del modelo a la vista._


La Arquitectura Orientada a Servicios (en inglés Service Oriented Architecture o SOA), es un concepto de arquitectura de software que define la utilización de servicios para dar soporte a los requerimientos de software del usuario.

Soluciones que implementen Arquitecturas Basada en Servicios  hay muchas, en su mayoría propietarias, pero requieren una gran curva de aprendizaje así como hardware de alta capacidad y complejos entornos para poder mantener en línea estos sistemas, PHP en conjunto con Aponwao propone un Framework que permite que el inicio, continuidad y creación de grandes sistemas empresariales y gubernamentales basados en una arquitectura orientada a servicios sea una tarea sencilla y de fácil acceso, de manera que esto realice un ágil cambio tecnológico; en cuanto al entorno es necesario contar con una excelente arquitectura, sin embargo nuestra solución permite que se instale en servidores comunes y de bajo requerimiento lo cual permitirá su fácil aceptación e integración con plataformas existentes, esto permitirá que la tecnología llegue a todos los habitantes.
SOA es una arquitectura de software que permite la creación y/o cambios de los procesos de negocio desde la perspectiva de TI de forma ágil, a través de la composición de nuevos procesos utilizando las funcionalidades de negocio que están contenidas en la infraestructura de aplicaciones actuales o futuras (expuestas bajo la forma de Webservices).

SOA define las siguientes capas de software:

  1. **Aplicaciones básicas**, sistemas desarrollados bajo cualquier arquitectura o tecnología, geográficamente dispersos y bajo cualquier figura de propiedad;
  1. **De exposición de funcionalidades**, donde las funcionalidades de la capa aplicativas son expuestas en forma de servicios (Webservices);
  1. **De integración de servicios**, facilitan el intercambio de datos entre elementos de la capa aplicativa orientada a procesos empresariales internos o en colaboración;
  1. **De composición de procesos**, que define el proceso en términos del negocio y sus necesidades, y que varía en función del negocio;
  1. **De entrega**, donde los servicios son desplegados a los usuarios finales.

Los beneficios que puede obtener una compañía que adopte SOA son:

  1. Facilidad para evolucionar a modelos de negocios basados en tercerización.
  1. Facilidad para abordar modelos de negocios basados en colaboración con otros entes (socios, proveedores).
  1. Poder para reemplazar elementos de la capa aplicativa SOA sin disrupción en el proceso de negocio.
  1. Facilidad para la integración de tecnologías disímiles.
  1. Mejora en los tiempos de realización de cambios en procesos.


**Aponwao Framework está basado principalmente en los siguientes conceptos:**

  * Compatible con muchas plataformas.
  * Fácil de instalar y configurar.
  * Fácil de aprender.
  * Listo para aplicaciones comerciales.
  * Convención sobre Configuración.
  * Simple y flexible para adaptarse a casos más complejos.
  * Soporta muchas características de Aplicaciones Web Actuales.
  * Soporta las prácticas y patrones de programación más productivos y eficientes.
  * Produce aplicaciones fáciles de mantener.
  * Basado en Software Libre y de Código Abierto.

El principal objetivo de Aponwao es producir aplicaciones que sean prácticas para el usuario final y no sólo para el programador. La mayor parte de las tareas que le quitan tiempo al desarrollador son automatizadas por Aponwao para que él pueda enfocarse en la lógica de negocio de su aplicación. No será necesario volver a inventar la rueda cada vez que se afronte un nuevo proyecto de software.

Para satisfacer estos objetivos Aponwao Framework está escrito en PHP5, última versión estable del lenguaje y que incorpora gran cantidad de mejoras en desempeño y soporte mejorado de Programación Orientada a Objetos (OOP). El mismo ha sido probado en aplicaciones reales que trabajan en diversas áreas con variedad de demanda y funcionalidad.


Aponwao Framework hereda de PHP5 una amplia compatibilidad con la mayoría de los motores de bases de datos actuales.

El modelo de objetos de Aponwao es utilizado en tres diferentes capas:
  * Abstracción de la base de datos.
  * Mapeo Objeto-Relacional.
  * Modelo MVC (Modelo, Vista, Controlador).
  * Compatible con el modelo SOA (Arquitectura basada en servicios).
  * Cada capa de la aplicación puede desarrollarse/funcionar de manera independiente permitiendo una separación física de la aplicación en diferentes servidores lo cual mejora el desempeño las aplicaciones desarrolladas en Aponwao.

Características comunes de Aplicaciones Web automatizadas por Aponwao:
  * Plantillas (XML/XHTML/HTML).
  * Validación de Formularios.
  * Administración de Caché.
  * Interacción AJAX.
  * Generación de Formularios.
  * Efectos Visuales.
  * Seguridad.
  * Publicación de Servicios Web.
  * Consumo de Servicios Web.

En el Proyecto Aponwao, creemos en el Software Libre y de Código Fuente Abierto. Por esta razón utilizamos algunos proyectos destacados en sus respectivas áreas de conocimiento para complementar la funcionalidad de Aponwao Framework:

  * PROPEL: Framework ORM. [PROPEL](http://propel.phpdb.org)
  * WSHELPER: Publicar y Proveer Servicios Web basados en SOAP.
  * NUSOAP: Consumo de Servicios Web desde PHP5.
  * PHPDOCUMENTOR: Documentación del Código Fuente.
  * PHPTAL: Plantillas XHTML. http://phptal.org
  * FPDF: Reportes en formato PDF.
  * PHPMailer: Correo Electrónico
  * JQUERY. Framework Javascript y AJAX.

## ¿GNU? ¿GPL? ##

Las licencias desarrolladas por la Free Software Foundation y el proyecto GNU son reconocidas a nivel global como licencias de Software Libre. Estas definen los principales conceptos y características que debe presentar una aplicación, libreria o código fuente para ser considerado libre.

Las licencias del modelo GNU se basan en las llamadas “4 libertades” del software libre:
Libertad 0: la libertad de usar el programa, con cualquier propósito.
Libertad 1: la libertad de estudiar cómo funciona el programa y modificarlo, adaptándolo a tus necesidades.
Libertad 2: la libertad de distribuir copias del programa, con lo cual puedes ayudar a tu prójimo.
Libertad 3: la libertad de mejorar el programa y hacer públicas esas mejoras a los demás, de modo que toda la comunidad se beneficie.

La Licencia Pública General de GNU, o GNU GPL es una licencia de software libre, y de tipo copyleft. Esta Licencia Publica cumple con  las 4 libertades del Software Libre mencionadas anteriormente.

El modelo de licenciamiento seleccionado para los productos del Proyecto Aponwao y sus derivados, es el modelo GNU bajo los términos de la Licencia Publica General de GNU (GNU GPL) en su versión 3.0

Este modelo garantiza la libertad del software, genera confianza en los usuarios y además anima a los desarrolladores y usuarios del producto a contribuir y desarrollar más software libre, mejorando así, la calidad y cantidad de herramientas libres disponibles para los desarrolladores el cual constituye uno de los principales objetivos del proyecto. Para más información sobre esta licencia,  por favor dirigirse a http://www.gnu.org/licenses/gpl.html