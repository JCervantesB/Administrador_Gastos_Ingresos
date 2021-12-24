<?php 

class optionModel extends Model
{

  public $id;
  public $opcion;
  public $val;
  public $created_at;
  public $updated_at;

  /**
   * Método para agregar un nuevo usuario
   *
   * @return integer
   */
  public function add()
  {
    $sql = 'INSERT INTO opciones (opcion, val, created_at) VALUES (:opcion, :val, :created_at)';
    $data = 
    [
      'opcion'       => $this->opcion,
      'val'          => $this->val,
      'created_at'   => now()
    ];

    try {
      return ($this->id = parent::query($sql, $data)) ? $this->id : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para cargar todas las opciones de la base de datos
   *
   * @return void
   */
  public function all()
  {
    $sql = 'SELECT * FROM opciones ORDER BY id DESC';
    try {
      return ($rows = parent::query($sql)) ? $rows : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para cargar un registro de la base de datos usando su id
   * Donde le pasamos una opcion y su valor en la columna val
   * 
   * @return void
   */
  public function one()
  {
    $sql = 'SELECT * FROM opciones WHERE opcion=:opcion LIMIT 1';
    try {
      return ($rows = parent::query($sql, ['opcion' => $this->opcion])) ? $rows[0] : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para actualizar un registor en la db
   *
   * @return bool
   */
  public function update()
  {
    $sql = 'UPDATE opciones SET val=:val WHERE opcion=:opcion';
    $data = 
    [
      'opcion' => $this->opcion,
      'val'    => $this->val,
    ];

    try {
      return (parent::query($sql, $data)) ? true : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para borrar un movimiento de la base de datos usando el id
   *
   * @return void
   */
  public function delete()
  {
    $sql = 'DELETE FROM opciones WHERE opcion = :opcion LIMIT 1';
    try {
      return (parent::query($sql, ['opcion' => $this->opcion])) ? true : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public static function save($opcion, $val)
  {
    // Verificar si existe la opción
    $self         = new self();
    $self->opcion = $opcion;
    $self->val    = $val;

    // Si no existe, guardar
    if(!$opcion = $self->one()) {
      return ($self->id = $self->add()) ? $self->id : false;
    }

    // Si existe, actualizar
    return $self->update();
  }

  /**
   * Método para buscar el valor de una opción determinada de forma estática
   *
   * @param string $opcion
   * @return void
   */
  public static function search($opcion)
  {
    // color
    // #ebebeb
    // opcionModel::search('color') -> #ebebeb;
    // opcionModel::search('sidebar_alignment') -> right;
    $self = new self();
    $self->opcion = $opcion;
    return ($res = $self->one()) ? $res['val'] : false;
  }
}