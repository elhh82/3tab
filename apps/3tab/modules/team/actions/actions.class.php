<?php
// auto-generated by sfPropelCrud
// date: 2008/04/20 18:59:53
?>
<?php

/**
 * team actions.
 *
 * @package    3tab
 * @subpackage team
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class teamActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('team', 'list');
  }

  public function executeViewRankings()
  {
	$this->teamScores = TeamScorePeer::getTeamsInRankedOrder();
  }
  
  public function executeViewTeamsMet()
  {
	$this->teams = TeamPeer::doSelect(new Criteria());
  }
  
  public function executeViewSpeakerRankings()
  {
	$this->speakerScores = SpeakerScorePeer::getDebatersInOrder();
  }

  public function executeViewTeamScoreConfirmation()
  {
      $c = new Criteria();
      $c->add(TeamPeer::ACTIVE, true);
      $c->addAscendingOrderByColumn(TeamPeer::NAME);

      $this->teams = TeamPeer::doSelect($c);
      $this->hideNavigationBar = true;

      return sfView::SUCCESS;
  }

  public function executeList()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(TeamPeer::NAME);
    $this->teams = TeamPeer::doSelect($c);
  }

  public function executeShow()
  {
    $this->team = TeamPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->team);
  }

  public function executeCreate()
  {
    $this->team = new Team();
    
    for($i = 0; $i < Team::getTeamSize(); $i++)
    {
        $debater = new Debater();
        $this->team->addDebater($debater);
    }
    
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->team = TeamPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->team);
  }
  
  public function validateUpdate()
  {
    $debaters = $this->getRequestParameter('debaters');
    $debaterErrors = array();

    foreach ($debaters as $count => $debater)
    {
      if (strlen($debater['name']) < 1)
      {
        $debaterErrors[$count]['name'] = 'Please fill in a name.';
      }

      $c = new Criteria();
      $c->add(DebaterPeer::NAME, $debater['name']);
      if (is_numeric($debater['debater_id']) and (int)$debater['debater_id'] > 0)
      {
        $c->add(DebaterPeer::ID, $debater['debater_id'], Criteria::NOT_EQUAL);
      }

      if (DebaterPeer::doCount($c) > 0)
      {
        $debaterErrors[$count]['name'] = 'A debater with this name already exists.';
      }
    }

    if (count($debaterErrors) > 0)
    {
      $this->getRequest()->setError('debaters', $debaterErrors);
    }

    return !$this->getRequest()->hasErrors();
  }

  public function handleErrorUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $this->forward('team', 'create');
    }
    else
    {
      $this->forward('team', 'edit');
    }
  }

  public function executeUpdate()
  {
	$propelConn = Propel::getConnection();
	try
	{
		$propelConn->begin();   
        if (!$this->getRequestParameter('id'))
        {
          $team = new Team();
        }
        else
        {
          $team = TeamPeer::retrieveByPk($this->getRequestParameter('id'), $propelConn);
          $this->forward404Unless($team);
        }
        
        $team->setId($this->getRequestParameter('id'));
        $team->setName($this->getRequestParameter('name'));
        $team->setInstitutionId($this->getRequestParameter('institution_id') ? $this->getRequestParameter('institution_id') : null);
        $team->setSwing($this->getRequestParameter('swing', 0));
        $team->setActive($this->getRequestParameter('active', 0));
        $team->save($propelConn);		
        
        foreach($this->getRequestParameter('debaters') as $aDebater)
        {
            if(!($aDebater['debater_id']))
            {
                $debater = new Debater();
            }
            else
            {
                $debater = DebaterPeer::retrieveByPk($aDebater['debater_id'], $propelConn);
            }
            
            $debater->setName($aDebater['name']);
            $debater->setTeam($team);
            
            $debater->save($propelConn);		
        }		
        
        $propelConn->commit();
        $this->setFlash("success", "Team was successfully saved.");
    }
    catch(Exception $e)
    {
        $propelConn->rollback();
        throw $e;
    }
    
    return $this->redirect('team/show?id='.$team->getId());
  }

  public function executeDelete()
  {
    $team = TeamPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($team);
		
    $team->delete();

    $this->setFlash("success", "Team ".$team->getName(). " was deleted.");

    return $this->redirect('team/list');
  }
}