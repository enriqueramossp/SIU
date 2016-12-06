<?php
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');


Route::auth();

//authenticathe
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['uses' => 'Auth\AuthController@postLogin', 'as' =>'auth/login']);
Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'auth/logout','middleware'=>'auth']);


// Password reset link request routes...
Route::get('password/email',['uses'=>'Auth\PasswordController@getEmail','as'=>'password/email'] );
Route::post('password/email',['uses'=>'Auth\PasswordController@postEmail','as'=>'password/email']);

// Password reset routes...
Route::get('password/reset/{token}',['uses'=>'Auth\PasswordController@getReset', 'as'=>'/password/reset/{token}'] );
Route::post('password/reset',['uses'=>'Auth\PasswordController@postReset','as'=>'/password/reset'] );



Route::get('usuarios',['uses'=>'UserController@Index','as'=>'usuarios','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('nuevousuario',['uses'=>'UserController@create','as'=>'nuevousuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::post('guardarusuario',['uses'=>'UserController@Store','as'=>'guardarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('editarusuario/{userid}/edit', ['uses' => 'UserController@edit', 'as' => 'editarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::put('actualizarusuario/{userid}', ['uses' => 'UserController@update', 'as' => 'actualizarusuario', 'middleware'=>'auth','middleware' => 'role:admin']);
Route::delete('eliminarusuario/{userid}',['uses'=>'UserController@Destroy','as'=>'eliminarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('activarusuario/{userid}', ['uses' => 'UserController@restore', 'as' => 'activarusuario','middleware'=>'auth','middleware' => 'role:admin']);

Route::get('permisos/{userid}', ['uses' => 'UserController@permisos', 'as' => 'permisos','middleware'=>'auth','middleware' => 'role:admin']);


//permisos
Route::put('cambiarpermiso', ['uses' => 'UserController@cambiarpermiso', 'as' => 'cambiarpermiso','middleware'=>'auth','middleware' => 'role:admin']);


Route::get('lideres', ['uses' => 'LideresController@index', 'as' => 'lideres','middleware'=>'auth','middleware' => 'permission:view.lider|add.lider']);
Route::get('editarlider/{id}/edit', ['uses' => 'LideresController@edit', 'as' => 'editarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::put('actualizarlider/{id}', ['uses' => 'LideresController@update', 'as' => 'actualizarlider', 'middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::delete('eliminarlider/{id}',['uses'=>'LideresController@Destroy','as'=>'eliminarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::get('nuevolider', ['uses' => 'LideresController@create', 'as' => 'nuevolider','middleware'=>'auth','middleware' => 'permission:add.lider']);
Route::post('guardarlider',['uses'=>'LideresController@store','as'=>'guardarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::get('consultalideres/{organizacion}/{modo}', ['uses' => 'LideresController@consulta', 'as' => 'consultalideres','middleware'=>'auth']);



//asignaciones
Route::get('asignaciones', ['uses' => 'AsignacionesController@index', 'as' => 'asignaciones','middleware'=>'auth','middleware' => 'permission:view.asignacion|add.asignacion']);
Route::get('buscarasignaciones/{datosbuscar}/{year}',['uses'=>'AsignacionesController@search','as'=>'buscarasignaciones','middleware' => 'permission:view.asignacion|add.asignacion']);

Route::get('nuevaasignacion', ['uses' => 'AsignacionesController@create', 'as' => 'nuevaasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::post('guardarasignacion',['uses'=>'AsignacionesController@store','as'=>'guardarasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::get('editarasignacion/{id}/edit', ['uses' => 'AsignacionesController@edit', 'as' => 'editarasignacion','middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('asignacion/{id}/show', ['uses' => 'AsignacionesController@show', 'as' => 'asignacion','middleware' =>'auth']);
Route::put('actualizarasignacionstatus/{id}', ['uses' => 'AsignacionesController@updatestatus', 'as' => 'actualizarasignacionstatus', 'middleware'=>'auth']);
Route::put('actualizarasignacion/{id}', ['uses' => 'AsignacionesController@update', 'as' => 'actualizarasignacion', 'middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('pdfasignacion/{id}/{evento}/{token}', ['uses' => 'AsignacionesController@pdf', 'as' => 'pdfasignacion']);


//entrevistas
Route::get('entrevistas', ['uses' => 'EntrevistasController@index', 'as' => 'entrevistas','middleware'=>'auth','middleware' => 'permission:view.entrevista|add.entrevista']);
Route::get('buscarentrevistas/{datosbuscar}/{year}',['uses'=>'EntrevistasController@search','as'=>'buscarentrevistas','middleware' => 'permission:view.asignacion|add.asignacion']);
Route::get('nuevaentrevista', ['uses' => 'EntrevistasController@create', 'as' => 'nuevaentrevista','middleware'=>'auth','middleware' => 'permission:add.entrevista']);
Route::post('guardarentrevista',['uses'=>'EntrevistasController@store','as'=>'guardarentrevista','middleware'=>'auth','middleware' => 'permission:add.entrevista']);
Route::get('editarentrevista/{id}/edit', ['uses' => 'EntrevistasController@edit', 'as' => 'editarentrevista','middleware'=>'auth','middleware' => 'permission:edit.entrevista']);
Route::get('entrevista/{id}/show', ['uses' => 'EntrevistasController@show', 'as' => 'entrevista','middleware'=>'auth']);
Route::put('actualizarentrevistastatus/{id}', ['uses' => 'EntrevistasController@updatestatus', 'as' => 'actualizarentrevistastatus', 'middleware'=>'auth']);
Route::put('actualizarentrevista/{id}', ['uses' => 'EntrevistasController@update', 'as' => 'actualizarentrevista', 'middleware'=>'auth','middleware' => 'permission:edit.entrevista']);
Route::get('pdfentrevista/{id}/{evento}/{token}', ['uses' => 'EntrevistasController@pdf', 'as' => 'pdfentrevista']);
Route::get('entrevistaview/{id}/{evento}/{token}', ['uses' => 'EntrevistasController@viewpdf', 'as' => 'pdfentrevista']);

//discursos
Route::get('discursos', ['uses' => 'DiscursosController@index', 'as' => 'discursos','middleware'=>'auth','middleware' => 'permission:view.discurso|add.discurso']);
Route::get('nuevodiscurso', ['uses' => 'DiscursosController@create', 'as' => 'nuevodiscurso','middleware'=>'auth','middleware' => 'permission:add.discurso']);
Route::post('guardardiscurso',['uses'=>'DiscursosController@store','as'=>'guardardiscurso','middleware'=>'auth','middleware' => 'permission:add.discurso']);
Route::get('editardiscurso/{id}/edit', ['uses' => 'DiscursosController@edit', 'as' => 'editardiscurso','middleware'=>'auth','middleware' => 'permission:edit.discurso']);
Route::get('discurso/{id}/show', ['uses' => 'DiscursosController@show', 'as' => 'discurso','middleware'=>'auth']);
Route::put('actualizardiscursostatus/{id}', ['uses' => 'DiscursosController@updatestatus', 'as' => 'actualizardiscursostatus', 'middleware'=>'auth']);
Route::put('actualizardiscurso/{id}', ['uses' => 'DiscursosController@update', 'as' => 'actualizardiscurso', 'middleware'=>'auth','middleware' => 'permission:edit.discurso']);
Route::get('pdfdiscurso/{id}/{evento}/{token}', ['uses' => 'DiscursosController@pdf', 'as' => 'pdfdiscurso']);
Route::get('buscardiscursos/{datosbuscar}/{year}',['uses'=>'DiscursosController@search','as'=>'buscardiscursos','middleware'=>'auth','middleware' => 'permission:view.discurso|add.discurso']);

//sit
Route::get('solicitudgasto',['uses'=>'SitController@nuevasolicitud','as'=>'solicitudgasto']);
Route::post('guardarsolicitud',['uses'=>'SitController@store','as'=>'guardarsolicitud']);
Route::get('solicitudes',['uses'=>'SitController@solicitudes','as'=>'solicitudes','middleware'=>'auth','middleware' => 'permission:view.solicitudes|edit.solicitudes']);
Route::get('solicitud/{id}/{token}',['uses'=>'SitController@status','as'=>'solicitud']);
Route::get('editarsolicitud/{id}',['uses'=>'SitController@editarsolicitud','as'=>'editarsolicitud','middleware'=>'auth','middleware' => 'permission:edit.solicitudes']);
Route::put('actualizarsolicitud/{id}', ['uses' => 'SitController@updatesolicitud', 'as' => 'actualizarsolicitud', 'middleware'=>'auth','middleware' => 'permission:edit.solicitudes']);
Route::delete('eliminarsolicitud/{id}',['uses'=>'SitController@eliminarsolicitud','as'=>'eliminarsolicitud','middleware'=>'auth','middleware' => 'permission:edit.solicitudes']);
Route::put('actualizarsit/{id}', ['uses' => 'SitController@updatesit', 'as' => 'actualizarsit', 'middleware'=>'auth','middleware' => 'permission:edit.sit']);
Route::get('crearsit/{id}',['uses'=>'SitController@crearsit','as'=>'crearsit','middleware'=>'auth','middleware' => 'permission:add.sit']);
Route::put('guardarsit/{id}',['uses'=>'SitController@guardarsit','as'=>'guardarsit','middleware'=>'auth','middleware' => 'permission:add.sit|edit:sit']);
Route::get('sits',['uses'=>'SitController@mostrarsits','as'=>'sits','middleware'=>'auth','middleware' => 'permission:view.sit|edit.sit']);
Route::put('actualizastatussit/{id}', ['uses' => 'SitController@updatestatus', 'as' => 'actualizastatussit', 'middleware'=>'auth']);
Route::get('pdfsit/{id}/{tipo}/{modo}/{token}', ['uses' => 'SitController@pdf', 'as' => 'pdfsit']);
Route::get('editarsit/{id}',['uses'=>'SitController@editarsit','as'=>'editarsit','middleware'=>'auth','middleware' => 'permission:edit.sit']);
Route::post('guardararchivo',['uses'=>'SitController@uploadfile','as'=>'guardararchivo','middleware'=>'auth','middleware' => 'permission:add.archivosit']);
Route::post('guardararchivoexterno/{token}',['uses'=>'SitController@uploadfileexterno','as'=>'guardararchivoexterno']);
Route::get('eliminararchivosit/{id}',['uses'=>'SitController@destroyfile','as'=>'eliminararchivosit','middleware'=>'auth','middleware' => 'permission:delete.filesit']);
Route::put('actualizavalidadocomporbante/{id}', ['uses' => 'SitController@updatevalidadopor', 'as' => 'actualizavalidadocomporbante', 'middleware'=>'auth']);

Route::get('buscarsits/{datosbuscar}/{year}/{status}',['uses'=>'SitController@search','as'=>'buscarsits','middleware' => 'permission:view.sit|edit.sit']);

Route::get('mostrarinfosit/{id}/show', ['uses' => 'SitController@show', 'as' => 'mostrarinfosit','middleware'=>'auth']);
Route::put('enviarcomprobantes/{id}', ['uses' => 'SitController@enviarcomprobantes', 'as' => 'enviarcomprobantes','middleware'=>'auth']);


//Bautizmales
Route::get('bautizmales', ['uses' => 'BautizmalController@index', 'as' => 'bautizmales','middleware'=>'auth','middleware' => 'permission:view.bautizmal']);
Route::get('nuevobautizmal', ['uses' => 'BautizmalController@create', 'as' => 'nuevobautizmal','middleware'=>'auth','middleware' => 'permission:add.bautizmal']);
Route::post('guardarbautizmal',['uses'=>'BautizmalController@store','as'=>'guardarbautizmal','middleware'=>'auth','middleware' => 'permission:add.bautizmal']);
Route::get('editarbautizmal/{id}/edit', ['uses' => 'BautizmalController@edit', 'as' => 'editarbautizmal','middleware'=>'auth','middleware' => 'permission:edit.bautizmal']);
Route::put('actualizabautizmal/{id}', ['uses' => 'BautizmalController@update', 'as' => 'actualizabautizmal', 'middleware'=>'auth','middleware' => 'permission:edit.bautizmal']);
Route::get('pdfbautizmal/{id}/{evento}', ['uses' => 'BautizmalController@pdf', 'as' => 'pdfbautizmal','middleware'=>'auth','middleware' => 'permission:print.bautizmal']);

//sacramentales
Route::get('sacramentales', ['uses' => 'SacramentalController@index', 'as' => 'sacramentales','middleware'=>'auth','middleware' => 'permission:view.sacramentales|add.sacramentales']);
Route::get('nuevosacramental', ['uses' => 'SacramentalController@add', 'as' => 'nuevosacramental','middleware'=>'auth','middleware' => 'permission:add.sacramentales']);
Route::post('guardarsacramental',['uses'=>'SacramentalController@store','as'=>'guardarsacramental','middleware'=>'auth','middleware' => 'permission:add.sacramentales']);
Route::get('editarsacramental/{id}/edit', ['uses' => 'SacramentalController@edit', 'as' => 'editarsacramental','middleware'=>'auth','middleware' => 'permission:edit.sacramentales']);
Route::put('actualizasacramental/{id}', ['uses' => 'SacramentalController@update', 'as' => 'actualizasacramental', 'middleware'=>'auth','middleware' => 'permission:edit.sacramentales']);
Route::get('pdfsacramental/{id}', ['uses' => 'SacramentalController@pdf', 'as' => 'pdfsacramental','middleware'=>'auth','middleware' => 'permission:print.sacramentales']);

Route::get('download', function() {
    return Response::download(\Illuminate\Support\Facades\Input::get('path'));
});
Route::get('barriosbyestaca/{idestaca}',['uses'=>'SitController@barrios','as'=>'barriosbyestaca']);

//recursos google
Route::get('eventos/{calendario}/{total}', ['uses' => 'ApigoogleController@calendar', 'as' => 'eventos']);


Route::get('calendario/{idbarrio}', ['uses' => 'ApigoogleController@fullcalendar', 'as' => 'calendario','middleware'=>'auth']);





//cumples
Route::get('cumples', ['uses' => 'CumplesController@index', 'as' => 'cumples','middleware'=>'auth','middleware' => 'permission:view.cumples|add.cumples']);
Route::get('listarcumples/{mes}', ['uses' => 'CumplesController@listar', 'as' => 'listarcumples','middleware'=>'auth','middleware' => 'permission:view.cumples|add.cumples']);
Route::get('nuevocumple', ['uses' => 'CumplesController@add', 'as' => 'nuevocumple','middleware'=>'auth','middleware' => 'permission:add.cumples']);
Route::get('edicarcumple/{id}/edit', ['uses' => 'CumplesController@edit', 'as' => 'edicarcumple','middleware'=>'auth','middleware' => 'permission:edit.cumples']);
Route::post('guardarcumple',['uses'=>'CumplesController@store','as'=>'guardarcumple','middleware'=>'auth','middleware' => 'permission:add.cumples']);
Route::get('cargamasiva', ['uses' => 'CumplesController@addmasiva', 'as' => 'cargamasiva','middleware'=>'auth','middleware' => 'permission:add.cumples']);

Route::post('cargararchivo',['uses'=>'CumplesController@uploadfile','as'=>'cargararchivo','middleware'=>'auth','middleware' => 'permission:add.cumples']);

Route::get('editarcumple/{id}', ['uses' => 'CumplesController@edit', 'as' => 'editarcumple','middleware'=>'auth','middleware' => 'permission:edit.cumples']);
Route::get('cumpleshow/{id}/show', ['uses' => 'CumplesController@show', 'as' => 'cumpleshow','middleware'=>'auth']);
Route::put('actualizacumple/{id}', ['uses' => 'CumplesController@update', 'as' => 'actualizacumple', 'middleware'=>'auth','middleware' => 'permission:edit.cumples']);
Route::delete('eliminarcumple/{id}',['uses'=>'CumplesController@Destroy','as'=>'eliminarcumple','middleware'=>'auth','middleware' => 'permission:edit.cumples']);



//enviar correo
Route::put('enviarcorreo/{id}/{modulo}',['uses'=>'EnviarCorreoController@enviarcorreo','as'=>'enviarcorreo','middleware'=>'auth']);

//himnos
Route::get('himnos/{valor}',['uses'=>'HimnosController@getautocompletarhimnos', 'as'=>'himnos','middleware'=>'auth']);


Route::get('notificasit',['uses'=>'NotificacionesController@sits', 'as'=>'notificasit']);

