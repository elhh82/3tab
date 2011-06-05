<?php
// auto-generated by sfPropelCrud
// date: 2008/06/28 16:50:23
?>
<?php

/**
 * adjudicator actions.
 *
 * @package    stab
 * @subpackage adjudicator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class adjudicatorActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('adjudicator', 'list');
  }

  public function executeList()
  {
	$this->round = RoundPeer::getCurrentRound();
    $this->adjudicators = AdjudicatorPeer::doSelect(new Criteria());
  }
  
  public function executeViewTeamsAdjudicated()
  {
	$this->adjudicators = AdjudicatorPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->adjudicator);
  }

  public function executeCreate()
  {
    $this->adjudicator = new Adjudicator();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->adjudicator);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $adjudicator = new Adjudicator();
    }
    else
    {
      $adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($adjudicator);
    }

    $adjudicator->setId($this->getRequestParameter('id'));
    $adjudicator->setName($this->getRequestParameter('name'));
    $adjudicator->setTestScore($this->getRequestParameter('test_score'));
    $adjudicator->setInstitutionId($this->getRequestParameter('institution_id') ? $this->getRequestParameter('institution_id') : null);
    $adjudicator->setActive($this->getRequestParameter('active', 0));	

    $adjudicator->save();

    return $this->redirect('adjudicator/show?id='.$adjudicator->getId());
  }

  public function executeDelete()
  {
    $adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($adjudicator);
	
    $adjudicator->delete();

    return $this->redirect('adjudicator/list');
  }
  
  public function executeDeleteConflict()
  {
	$conflict = AdjudicatorConflictPeer::retrieveByPk($this->getRequestParameter('conflictId'));
	$adjudicator = $conflict->getAdjudicator();
	
	$this->forward404Unless($conflict);
	
	$conflict->delete();
	
	return $this->redirect('adjudicator/edit?id='.$adjudicator->getId());
  }
  
  public function executeAddConflict()
  {
	$this->adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
	
	$this->forward404Unless($this->adjudicator);
	
	$this->teams = TeamPeer::doSelect(new Criteria());
  }
  
  public function executeCreateConflict()
  {
	$adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
	$team = TeamPeer::retrieveByPk($this->getRequestParameter('teamId'));
	$conflict = $adjudicator->createConflict($team);
	if($conflict)
	{
		$adjudicator->addAdjudicatorConflict($conflict);
	}
	$adjudicator->save();
	return $this->redirect('adjudicator/edit?id='.$adjudicator->getId());
  }
  
  public function executeShowFeedback()
  {
	$this->adjudicator = AdjudicatorPeer::retrieveByPk($this->getRequestParameter('id'));
	$this->feedbackSheets = $this->adjudicator->getAdjudicatorFeedbackSheets();  
  }
  
  public function executeEditFeedback()
  {
  
  }	
}
