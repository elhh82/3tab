<?php
// auto-generated by sfPropelCrud
// date: 2008/04/20 18:55:06
?>
<?php

/**
 * institution actions.
 *
 * @package    3tab
 * @subpackage institution
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class institutionActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('institution', 'list');
  }

  public function executeList()
  {
    $this->institutions = InstitutionPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->institution = InstitutionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->institution);
  }

  public function executeCreate()
  {
    $this->institution = new Institution();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->institution = InstitutionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->institution);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $institution = new Institution();
    }
    else
    {
      $institution = InstitutionPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($institution);
    }

    $institution->setId($this->getRequestParameter('id'));
    $institution->setCode($this->getRequestParameter('code'));
    $institution->setName($this->getRequestParameter('name'));

    $institution->save();

    return $this->redirect('institution/show?id='.$institution->getId());
  }

  public function executeDelete()
  {
    $institution = InstitutionPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($institution);

    $institution->delete();

    return $this->redirect('institution/list');
  }
}
