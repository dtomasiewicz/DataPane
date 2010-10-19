<?php
	namespace DataPane\Platform;
	use \DataPane\Query;
	
	class MySQL {
		public static function parseQuery(Query $query) {
			$sql = $query->type;
			
			if($query->type == Query::SELECT) {
				$sql .= ' '.self::_parseFields($query->fields);
			}
			
			if($query->type == Query::SELECT || $query->type == Query::DELETE) {
				$sql .= ' FROM '.self::_parseFrom($query->from);
			}
			
			if($query->type != Query::INSERT && $query->where) {
				$sql .= ' WHERE '.self::_parseConditions($query->where);
			}
			
			if($query->type != Query::INSERT && $query->order) {
				$sql .= ' ORDER BY '.self::_parseOrder($query->order);
			}
			
			if($query->type != Query::INSERT && $query->limit) {
				$sql .= ' LIMIT '.self::_parseLimit($query->limit, $query->offset);
			}
			
			if($query->type == Query::SELECT && $query->having) {
				$sql .= ' HAVING '.self::_parseConditions($query->having);
			}
			
			if($query->type == Query::SELECT && $query->group) {
				$sql .= ' GROUP BY '.self::_parseOrder($query->group);
			}
			
			return $sql;
		}
		
		protected static function _parseFields($fields) {
			return $fields === null ? '*' : $fields;
		}
		
		protected static function _parseFrom($from) {
			return is_array($from) ? implode(',', $from) : $from;
		} 
		
		protected static function _parseConditions($conditions) {
			if(!count($conditions)) {
				return null;
			} elseif(is_string($conditions[0])) {
				return $conditions[0];
			} else {
				$sql = '';
				$subs = array();
				for($c = 0; $c < count($conditions); $c++) {
					if(is_array($conditions[$c])) {
						$p = self::parseConditions($conditions[$c]);
						$sql .= '('.array_shift($p).')';
						$subs = array_merge($subs, $p);
					}
					if($c < count($conditions)-1) {
						if(is_string($conditions[$i+1])) {
							$sql .= ' '.$conditions[$i+1].' ';
							$i++;
						} else {
							$sql .= ' AND ';
						}
					}
				}
				//@todo something with $subs
				return $sql;
			}
		}
		
		protected static function _parseOrder($order) {
			return is_array($order) ? implode(',', $order) : $order;
		}
		
		protected static function _parseLimit($limit, $offset) {
			if($limit !== null) {
				if($offset !== null) {
					return $offset.','.$limit;
				} else {
					return $limit;
				}
			} else {
				return null;
			}
		}
	}