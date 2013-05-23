<?php

	class HtmlParser
	{
	
		public static function StringClear ( $string )
		{
			return preg_replace ( array ( '#\\n#' , '#\\r#' , '#\\t#' ) , '' , $string );
		}
	
		public static function StringCut ( $string , $beginPattern , $endPattern , $inner = true )
		{
			if ( $beginPattern != '' )
			{
				if ( preg_match ( $beginPattern , $string, $matches , PREG_OFFSET_CAPTURE ) )
				{
					$cutBegin = $matches[0][1];
					if ( $inner )
					{
						$cutBegin += strlen ( $matches[0][0] );
					}
				}
				else
				{
					$cutBegin = 0;
				}
			}
			else
			{
				$cutBegin = 0;
			}
			
			if ( $endPattern != '' )
			{
				if ( preg_match ( $endPattern , $string , $matches , PREG_OFFSET_CAPTURE , $cutBegin  ) )
				{
					$cutEnd = $matches[0][1] - $cutBegin;
				
					if ( !$inner )
					{
						$cutEnd += strlen ( $matches[0][0] ) + 1;
					}
				}
				else
				{
					$cutEnd = strlen ( $string ) - $cutBegin;
				}
			}
			else
			{
				$cutEnd = strlen ( $string ) - $cutBegin;
			}
			
			return substr( $string , $cutBegin , $cutEnd );	
		}
	
		public static function TagContentGet ( $tag )
		{
			return HtmlParser::StringCut ( $tag , '#>#' , '#<#' );
		}
	
		public static function AttributeValueGet ( $attribute )
		{
			return preg_replace ( array ( '#^.{0,}="#' , '#"$#' ) , '' , $attribute );
		}
	
	};

?>