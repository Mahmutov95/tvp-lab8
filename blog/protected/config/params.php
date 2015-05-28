<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',

	'facebookApi'=>array(
		'id'=>'1403157526657409',
		'secret'=>'6e79d4d81541378d2dfbb7b90225b2d5',
		'token'=>'CAAT8KhHwuYEBANV0NR6EZATEaSeVc5MeOrZAGYxGE5ZAndL0kRn1DYiRxvSHC0RBOorHFK30ESFiJbTTtb0uQjDrIegwZAnmVGMJNRrJ8XNYZBfeZBZCG9ha29UU2VCZBvBJpXgmqOoZAlNzSsoh8aPW704krJXUAumcTBWQX3lIa2CxCY0IgSmNJZCtr6fgmxBqvCymeuwaL2yYTpK1dxRsigbMjf7ZCj45YsZD'
	)
);
