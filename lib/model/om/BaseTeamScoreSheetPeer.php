<?php


abstract class BaseTeamScoreSheetPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'team_score_sheets';

	
	const CLASS_DEFAULT = 'lib.model.TeamScoreSheet';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'team_score_sheets.ID';

	
	const ADJUDICATOR_ALLOCATION_ID = 'team_score_sheets.ADJUDICATOR_ALLOCATION_ID';

	
	const DEBATE_TEAM_XREF_ID = 'team_score_sheets.DEBATE_TEAM_XREF_ID';

	
	const SCORE = 'team_score_sheets.SCORE';

	
	const CREATED_AT = 'team_score_sheets.CREATED_AT';

	
	const UPDATED_AT = 'team_score_sheets.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AdjudicatorAllocationId', 'DebateTeamXrefId', 'Score', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (TeamScoreSheetPeer::ID, TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, TeamScoreSheetPeer::SCORE, TeamScoreSheetPeer::CREATED_AT, TeamScoreSheetPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'adjudicator_allocation_id', 'debate_team_xref_id', 'score', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AdjudicatorAllocationId' => 1, 'DebateTeamXrefId' => 2, 'Score' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (TeamScoreSheetPeer::ID => 0, TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID => 1, TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID => 2, TeamScoreSheetPeer::SCORE => 3, TeamScoreSheetPeer::CREATED_AT => 4, TeamScoreSheetPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'adjudicator_allocation_id' => 1, 'debate_team_xref_id' => 2, 'score' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/TeamScoreSheetMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.TeamScoreSheetMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TeamScoreSheetPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(TeamScoreSheetPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TeamScoreSheetPeer::ID);

		$criteria->addSelectColumn(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID);

		$criteria->addSelectColumn(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID);

		$criteria->addSelectColumn(TeamScoreSheetPeer::SCORE);

		$criteria->addSelectColumn(TeamScoreSheetPeer::CREATED_AT);

		$criteria->addSelectColumn(TeamScoreSheetPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(team_score_sheets.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT team_score_sheets.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = TeamScoreSheetPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TeamScoreSheetPeer::populateObjects(TeamScoreSheetPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TeamScoreSheetPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TeamScoreSheetPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAdjudicatorAllocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDebateTeamXref(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAdjudicatorAllocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TeamScoreSheetPeer::addSelectColumns($c);
		$startcol = (TeamScoreSheetPeer::NUM_COLUMNS - TeamScoreSheetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AdjudicatorAllocationPeer::addSelectColumns($c);

		$c->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TeamScoreSheetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AdjudicatorAllocationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAdjudicatorAllocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTeamScoreSheet($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTeamScoreSheets();
				$obj2->addTeamScoreSheet($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDebateTeamXref(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TeamScoreSheetPeer::addSelectColumns($c);
		$startcol = (TeamScoreSheetPeer::NUM_COLUMNS - TeamScoreSheetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DebateTeamXrefPeer::addSelectColumns($c);

		$c->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TeamScoreSheetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DebateTeamXrefPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDebateTeamXref(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTeamScoreSheet($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTeamScoreSheets();
				$obj2->addTeamScoreSheet($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);

		$criteria->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TeamScoreSheetPeer::addSelectColumns($c);
		$startcol2 = (TeamScoreSheetPeer::NUM_COLUMNS - TeamScoreSheetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AdjudicatorAllocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AdjudicatorAllocationPeer::NUM_COLUMNS;

		DebateTeamXrefPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DebateTeamXrefPeer::NUM_COLUMNS;

		$c->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);

		$c->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TeamScoreSheetPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AdjudicatorAllocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAdjudicatorAllocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTeamScoreSheet($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initTeamScoreSheets();
				$obj2->addTeamScoreSheet($obj1);
			}


					
			$omClass = DebateTeamXrefPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDebateTeamXref(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addTeamScoreSheet($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initTeamScoreSheets();
				$obj3->addTeamScoreSheet($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAdjudicatorAllocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDebateTeamXref(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TeamScoreSheetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);

		$rs = TeamScoreSheetPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAdjudicatorAllocation(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TeamScoreSheetPeer::addSelectColumns($c);
		$startcol2 = (TeamScoreSheetPeer::NUM_COLUMNS - TeamScoreSheetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DebateTeamXrefPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DebateTeamXrefPeer::NUM_COLUMNS;

		$c->addJoin(TeamScoreSheetPeer::DEBATE_TEAM_XREF_ID, DebateTeamXrefPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TeamScoreSheetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DebateTeamXrefPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDebateTeamXref(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTeamScoreSheet($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTeamScoreSheets();
				$obj2->addTeamScoreSheet($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDebateTeamXref(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TeamScoreSheetPeer::addSelectColumns($c);
		$startcol2 = (TeamScoreSheetPeer::NUM_COLUMNS - TeamScoreSheetPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AdjudicatorAllocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AdjudicatorAllocationPeer::NUM_COLUMNS;

		$c->addJoin(TeamScoreSheetPeer::ADJUDICATOR_ALLOCATION_ID, AdjudicatorAllocationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TeamScoreSheetPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AdjudicatorAllocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAdjudicatorAllocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTeamScoreSheet($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTeamScoreSheets();
				$obj2->addTeamScoreSheet($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return TeamScoreSheetPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(TeamScoreSheetPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TeamScoreSheetPeer::ID);
			$selectCriteria->add(TeamScoreSheetPeer::ID, $criteria->remove(TeamScoreSheetPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(TeamScoreSheetPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(TeamScoreSheetPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof TeamScoreSheet) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TeamScoreSheetPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(TeamScoreSheet $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TeamScoreSheetPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TeamScoreSheetPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(TeamScoreSheetPeer::DATABASE_NAME, TeamScoreSheetPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TeamScoreSheetPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(TeamScoreSheetPeer::DATABASE_NAME);

		$criteria->add(TeamScoreSheetPeer::ID, $pk);


		$v = TeamScoreSheetPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(TeamScoreSheetPeer::ID, $pks, Criteria::IN);
			$objs = TeamScoreSheetPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTeamScoreSheetPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/TeamScoreSheetMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.TeamScoreSheetMapBuilder');
}
