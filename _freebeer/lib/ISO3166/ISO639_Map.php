<?php

// $CVSHeader: _freebeer/lib/ISO3166/ISO639_Map.php,v 1.2 2004/03/07 17:51:21 ross Exp $

// Copyright (c) 2002-2004, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See license.txt for details.

/*!
	\file ISO3166/ISO639_Map.php
	\brief ISO 3166 (country codes) to ISO 639 (language codes) map
*/

defined('FREEBEER_BASE') || define('FREEBEER_BASE', getenv('FREEBEER_BASE') ? getenv('FREEBEER_BASE') :
	dirname(dirname(dirname(__FILE__))));

if (phpversion() <= '4.2.0') {
	include_once FREEBEER_BASE . '/lib/Backport.php'; // array_change_key_case
}

/*!
	\class fbISO3166_ISO639_Map
	\brief ISO 3166 (country codes) to ISO 639 (language codes) map

	\static
*/
class fbISO3166_ISO639_Map {
	/*!
		\see http://www.w3.org/WAI/ER/IG/ert/iso639.htm
		\see http://www.iso.ch/iso/en/prods-services/iso3166ma/02iso-3166-code-lists/list-en1-semic.txt

		\return \c array
		\static
	*/
	function &getCountryIDToLanguageIDHash() {
		static $COUNTRY_ID_TO_LANGUAGE_ID_HASH = array(
			'AF'	=> 'PS',	// 'Afghanistan'	=> 'Pashto'
			'AL'	=> 'SQ',	// 'Albania'	=> 'Albanian'
			'DZ'	=> '',		// 'Algeria'	=> ''
			'AS'	=> '',		// 'American Samoa'	=> ''
			'AD'	=> '',		// 'Andorra'	=> ''
			'AO'	=> '',		// 'Angola'	=> ''
			'AI'	=> '',		// 'Anguilla'	=> ''
			'AQ'	=> '',		// 'Antarctica'	=> ''
			'AG'	=> '',		// 'Antigua and Barbuda'	=> ''
			'AR'	=> '',		// 'Argentina'	=> ''
			'AM'	=> 'HY',	// 'Armenia'	=> 'Armenian'
			'AW'	=> '',		// 'Aruba'	=> ''
			'AU'	=> 'EN',	// 'Australia'	=> 'English'
			'AT'	=> '',		// 'Austria'	=> ''
			'AZ'	=> 'AZ',	// 'Azerbaijan'	=> 'Azerbaijani'
			'BS'	=> '',		// 'Bahamas'	=> ''
			'BH'	=> '',		// 'Bahrain'	=> ''
			'BD'	=> '',		// 'Bangladesh'	=> ''
			'BB'	=> '',		// 'Barbados'	=> ''
			'BY'	=> '',		// 'Belarus'	=> ''
			'BE'	=> '',		// 'Belgium'	=> ''
			'BZ'	=> '',		// 'Belize'	=> ''
			'BJ'	=> '',		// 'Benin'	=> ''
			'BM'	=> '',		// 'Bermuda'	=> ''
			'BT'	=> 'DZ',	// 'Bhutan'	=> 'Bhutani'
			'BO'	=> '',		// 'Bolivia'	=> ''
			'BA'	=> '',		// 'Bosnia and Herzegovina'	=> ''
			'BW'	=> '',		// 'Botswana'	=> ''
			'BV'	=> '',		// 'Bouvet Island'	=> ''
			'BR'	=> '',		// 'Brazil'	=> ''
			'IO'	=> '',		// 'British Indian Ocean Territory'	=> ''
			'BN'	=> '',		// 'Brunei Darussalam'	=> ''
			'BG'	=> 'BG',	// 'Bulgaria'	=> 'Bulgarian'
			'BF'	=> '',		// 'Burkina Faso'	=> ''
			'BI'	=> '',		// 'Burundi'	=> ''
			'KH'	=> 'KM',	// 'Cambodia'	=> 'Cambodian'
			'CM'	=> '',		// 'Cameroon'	=> ''
			'CA'	=> 'EN',	// 'Canada'	=> 'English'
			'CV'	=> '',		// 'Cape Verde'	=> ''
			'KY'	=> '',		// 'Cayman Islands'	=> ''
			'CF'	=> '',		// 'Central African Republic'	=> ''
			'TD'	=> '',		// 'Chad'	=> ''
			'CL'	=> '',		// 'Chile'	=> ''
			'CN'	=> 'ZH',	// 'China'	=> 'Chinese'
			'CX'	=> '',		// 'Christmas Island'	=> ''
			'CC'	=> '',		// 'Cocos (Keeling) Islands'	=> ''
			'CO'	=> '',		// 'Colombia'	=> ''
			'KM'	=> '',		// 'Comoros'	=> ''
			'CG'	=> '',		// 'Congo'	=> ''
			'CD'	=> '',		// 'Congo, The Democratic Republic of the'	=> ''
			'CK'	=> '',		// 'Cook Islands'	=> ''
			'CR'	=> '',		// 'Costa Rica'	=> ''
			'CI'	=> '',		// 'Cote D'Ivoire'	=> ''
			'HR'	=> 'HR',	// 'Croatia'	=> 'Croatian'
			'CU'	=> '',		// 'Cuba'	=> ''
			'CY'	=> '',		// 'Cyprus'	=> ''
			'CZ'	=> 'CS',	// 'Czech Republic'	=> 'Czech'
			'DK'	=> 'DA',	// 'Denmark'	=> 'Danish'
			'DJ'	=> '',		// 'Djibouti'	=> ''
			'DM'	=> '',		// 'Dominica'	=> ''
			'DO'	=> '',		// 'Dominican Republic'	=> ''
			'EC'	=> '',		// 'Ecuador'	=> ''
			'EG'	=> '',		// 'Egypt'	=> ''
			'SV'	=> '',		// 'El Salvador'	=> ''
			'GQ'	=> '',		// 'Equatorial Guinea'	=> ''
			'ER'	=> '',		// 'Eritrea'	=> ''
			'EE'	=> 'ET',	// 'Estonia'	=> 'Estonian'
			'ET'	=> '',		// 'Ethiopia'	=> ''
			'FK'	=> '',		// 'Falkland Islands (Malvinas)'	=> ''
			'FO'	=> 'FO',	// 'Faroe Islands'	=> 'Faeroese'
			'FJ'	=> 'FJ',	// 'Fiji'	=> 'Fiji'
			'FI'	=> 'FI',	// 'Finland'	=> 'Finnish'
			'FR'	=> 'FR',	// 'France'	=> 'French'
			'GF'	=> '',		// 'French Guiana'	=> ''
			'PF'	=> '',		// 'French Polynesia'	=> ''
			'TF'	=> '',		// 'French Southern Territories'	=> ''
			'GA'	=> '',		// 'Gabon'	=> ''
			'GM'	=> '',		// 'Gambia'	=> ''
			'GE'	=> 'KA',	// 'Georgia'	=> 'Georgian'
			'DE'	=> 'DE',	// 'Germany'	=> 'German'
			'GH'	=> '',		// 'Ghana'	=> ''
			'GI'	=> '',		// 'Gibraltar'	=> ''
			'GR'	=> 'EL',	// 'Greece'	=> 'Greek'
			'GL'	=> 'KL',	// 'Greenland'	=> 'Greenlandic'
			'GD'	=> '',		// 'Grenada'	=> ''
			'GP'	=> '',		// 'Guadeloupe'	=> ''
			'GU'	=> '',		// 'Guam'	=> ''
			'GT'	=> '',		// 'Guatemala'	=> ''
			'GN'	=> '',		// 'Guinea'	=> ''
			'GW'	=> '',		// 'Guinea-Bissau'	=> ''
			'GY'	=> '',		// 'Guyana'	=> ''
			'HT'	=> '',		// 'Haiti'	=> ''
			'HM'	=> '',		// 'Heard Island and McDonald Islands'	=> ''
			'VA'	=> '',		// 'Holy See (Vatican City State)'	=> ''
			'HN'	=> '',		// 'Honduras'	=> ''
			'HK'	=> '',		// 'Hong Kong'	=> ''
			'HU'	=> 'HU',	// 'Hungary'	=> 'Hungarian'
			'IS'	=> 'IS',	// 'Iceland'	=> 'Icelandic'
			'IN'	=> 'HI',	// 'India'	=> 'Hindi'
			'ID'	=> 'IN',	// 'Indonesia'	=> 'Indonesian'
			'IR'	=> '',		// 'Iran, Islamic Republic of'	=> ''
			'IQ'	=> '',		// 'Iraq'	=> ''
			'IE'	=> 'GA',	// 'Ireland'	=> 'Irish'
			'IL'	=> 'IW',	// 'Israel'	=> 'Hebrew'
			'IT'	=> 'IT',	// 'Italy'	=> 'Italian'
			'JM'	=> '',		// 'Jamaica'	=> ''
			'JP'	=> 'JA',	// 'Japan'	=> 'Japanese'
			'JO'	=> '',		// 'Jordan'	=> ''
			'KZ'	=> 'KK',	// 'Kazakhstan'	=> 'Kazakh'
			'KE'	=> '',		// 'Kenya'	=> ''
			'KI'	=> '',		// 'Kiribati'	=> ''
			'KP'	=> '',		// 'Korea, Democratic People's Republic of'	=> ''
			'KR'	=> 'KO',	// 'Korea, Republic of'	=> 'Korean'
			'KW'	=> '',		// 'Kuwait'	=> ''
			'KG'	=> 'KY',	// 'Kyrgyzstan'	=> 'Kirghiz'
			'LA'	=> '',		// 'Lao People's Democratic Republic'	=> ''
			'LV'	=> 'LV',	// 'Latvia'	=> 'Latvian'
			'LB'	=> '',		// 'Lebanon'	=> ''
			'LS'	=> '',		// 'Lesotho'	=> ''
			'LR'	=> '',		// 'Liberia'	=> ''
			'LY'	=> '',		// 'Libyan Arab Jamahiriya'	=> ''
			'LI'	=> '',		// 'Liechtenstein'	=> ''
			'LT'	=> 'LT',	// 'Lithuania'	=> 'Lithuanian'
			'LU'	=> '',		// 'Luxembourg'	=> ''
			'MO'	=> '',		// 'Macao'	=> ''
			'MK'	=> 'MK',	// 'Macedonia, the Former Yugoslav Republic of'	=> 'Macedonian'
			'MG'	=> 'MG',	// 'Madagascar'	=> 'Malagasy'
			'MW'	=> '',		// 'Malawi'	=> ''
			'MY'	=> 'MS',	// 'Malaysia'	=> 'Malay'
			'MV'	=> '',		// 'Maldives'	=> ''
			'ML'	=> '',		// 'Mali'	=> ''
			'MT'	=> 'MT',	// 'Malta'	=> 'Maltese'
			'MH'	=> '',		// 'Marshall Islands'	=> ''
			'MQ'	=> '',		// 'Martinique'	=> ''
			'MR'	=> '',		// 'Mauritania'	=> ''
			'MU'	=> '',		// 'Mauritius'	=> ''
			'YT'	=> '',		// 'Mayotte'	=> ''
			'MX'	=> '',		// 'Mexico'	=> ''
			'FM'	=> '',		// 'Micronesia, Federated States of'	=> ''
			'MD'	=> 'MO',	// 'Moldova, Republic of'	=> 'Moldavian'
			'MC'	=> '',		// 'Monaco'	=> ''
			'MN'	=> 'MN',	// 'Mongolia'	=> 'Mongolian'
			'MS'	=> '',		// 'Montserrat'	=> ''
			'MA'	=> '',		// 'Morocco'	=> ''
			'MZ'	=> '',		// 'Mozambique'	=> ''
			'MM'	=> 'MY',	// 'Myanmar'	=> 'Burmese'
			'NA'	=> '',		// 'Namibia'	=> ''
			'NR'	=> 'NA',	// 'Nauru'	=> 'Nauru'
			'NP'	=> 'NE',	// 'Nepal'	=> 'Nepali'
			'NL'	=> 'NL',	// 'Netherlands'	=> 'Dutch'
			'AN'	=> '',		// 'Netherlands Antilles'	=> ''
			'NC'	=> '',		// 'New Caledonia'	=> ''
			'NZ'	=> 'EN',	// 'New Zealand'	=> 'English'
			'NI'	=> '',		// 'Nicaragua'	=> ''
			'NE'	=> '',		// 'Niger'	=> ''
			'NG'	=> '',		// 'Nigeria'	=> ''
			'NU'	=> '',		// 'Niue'	=> ''
			'NF'	=> '',		// 'Norfolk Island'	=> ''
			'MP'	=> '',		// 'Northern Mariana Islands'	=> ''
			'NO'	=> 'NB',	// 'Norway'	=> 'Norwegian'
			'OM'	=> '',		// 'Oman'	=> ''
			'PK'	=> 'PA',	// 'Pakistan'	=> 'Punjabi'
			'PW'	=> '',		// 'Palau'	=> ''
			'PS'	=> '',		// 'Palestinian Territory, Occupied'	=> ''
			'PA'	=> '',		// 'Panama'	=> ''
			'PG'	=> '',		// 'Papua New Guinea'	=> ''
			'PY'	=> 'GN',	// 'Paraguay'	=> 'Guarani'
			'PE'	=> '',		// 'Peru'	=> ''
			'PH'	=> 'TL',	// 'Philippines'	=> 'Tagalog'
			'PN'	=> '',		// 'Pitcairn'	=> ''
			'PL'	=> 'PL',	// 'Poland'	=> 'Polish'
			'PT'	=> 'PT',	// 'Portugal'	=> 'Portuguese'
			'PR'	=> '',		// 'Puerto Rico'	=> ''
			'QA'	=> '',		// 'Qatar'	=> ''
			'RE'	=> '',		// 'Reunion'	=> ''
			'RO'	=> 'RO',	// 'Romania'	=> 'Romanian'
			'RU'	=> 'RU',	// 'Russian Federation'	=> 'Russian'
			'RW'	=> '',		// 'Rwanda'	=> ''
			'SH'	=> '',		// 'Saint Helena'	=> ''
			'KN'	=> '',		// 'Saint Kitts and Nevis'	=> ''
			'LC'	=> '',		// 'Saint Lucia'	=> ''
			'PM'	=> '',		// 'Saint Pierre and Miquelon'	=> ''
			'VC'	=> '',		// 'Saint Vincent and the Grenadines'	=> ''
			'WS'	=> 'SM',	// 'Samoa'	=> 'Samoan'
			'SM'	=> '',		// 'San Marino'	=> ''
			'ST'	=> '',		// 'Sao Tome and Principe'	=> ''
			'SA'	=> '',		// 'Saudi Arabia'	=> ''
			'SN'	=> 'SI',	// 'Senegal'	=> 'Singhalese'
			'CS'	=> 'SR',	// 'Serbia and Montenegro'	=> 'Serbian'
			'SC'	=> '',		// 'Seychelles'	=> ''
			'SL'	=> '',		// 'Sierra Leone'	=> ''
			'SG'	=> '',		// 'Singapore'	=> ''
			'SK'	=> 'SK',	// 'Slovakia'	=> 'Slovak'
			'SI'	=> 'SL',	// 'Slovenia'	=> 'Slovenian'
			'SB'	=> '',		// 'Solomon Islands'	=> ''
			'SO'	=> 'SO',	// 'Somalia'	=> 'Somali'
			'ZA'	=> 'AF',	// 'South Africa'	=> 'Afrikaans'
			'GS'	=> '',		// 'South Georgia and the South Sandwich Islands'	=> ''
			'ES'	=> 'ES',	// 'Spain'	=> 'Spanish'
			'LK'	=> '',		// 'Sri Lanka'	=> ''
			'SD'	=> 'SU',	// 'Sudan'	=> 'Sudanese'
			'SR'	=> '',		// 'Suriname'	=> ''
			'SJ'	=> '',		// 'Svalbard and Jan Mayen'	=> ''
			'SZ'	=> 'SW',	// 'Swaziland'	=> 'Swahili'
			'SE'	=> 'SV',	// 'Sweden'	=> 'Swedish'
			'CH'	=> '',		// 'Switzerland'	=> ''
			'SY'	=> '',		// 'Syrian Arab Republic'	=> ''
			'TW'	=> '',		// 'Taiwan, Province of China'	=> ''
			'TJ'	=> 'TG',	// 'Tajikistan'	=> 'Tajik'
			'TZ'	=> '',		// 'Tanzania, United Republic of'	=> ''
			'TH'	=> 'TH',	// 'Thailand'	=> 'Thai'
			'TL'	=> '',		// 'Timor-Leste'	=> ''
			'TG'	=> '',		// 'Togo'	=> ''
			'TK'	=> '',		// 'Tokelau'	=> ''
			'TO'	=> 'TO',	// 'Tonga'	=> 'Tonga'
			'TT'	=> '',		// 'Trinidad and Tobago'	=> ''
			'TN'	=> '',		// 'Tunisia'	=> ''
			'TR'	=> 'TR',	// 'Turkey'	=> 'Turkish'
			'TM'	=> 'TK',	// 'Turkmenistan'	=> 'Turkmen'
			'TC'	=> '',		// 'Turks and Caicos Islands'	=> ''
			'TV'	=> '',		// 'Tuvalu'	=> ''
			'UG'	=> '',		// 'Uganda'	=> ''
			'UA'	=> 'UK',	// 'Ukraine'	=> 'Ukrainian'
			'AE'	=> '',		// 'United Arab Emirates'	=> ''
			'GB'	=> 'EN',	// 'United Kingdom'	=> 'English'
			'US'	=> 'EN',	// 'United States'	=> 'English'
			'UM'	=> '',		// 'United States Minor Outlying Islands'	=> ''
			'UY'	=> '',		// 'Uruguay'	=> ''
			'UZ'	=> 'UZ',	// 'Uzbekistan'	=> 'Uzbek'
			'VU'	=> '',		// 'Vanuatu'	=> ''
			'VE'	=> '',		// 'Venezuela'	=> ''
			'VN'	=> 'VI',	// 'Viet Nam'	=> 'Vietnamese'
			'VG'	=> '',		// 'Virgin Islands, British'	=> ''
			'VI'	=> '',		// 'Virgin Islands, U.S.'	=> ''
			'WF'	=> '',		// 'Wallis and Futuna'	=> ''
			'EH'	=> '',		// 'Western Sahara'	=> ''
			'YE'	=> '',		// 'Yemen'	=> ''
			'ZM'	=> '',		// 'Zambia'	=> ''
			'ZW'	=> '',		// 'Zimbabwe'	=> ''
		);

		// make sure no dups snuck in
		assert('count($COUNTRY_ID_TO_LANGUAGE_ID_HASH) == 239');

		return $COUNTRY_ID_TO_LANGUAGE_ID_HASH;
	}

	/*!
		\static
	*/
	function getLanguageID($country_id) {
		$COUNTRY_ID_TO_LANGUAGE_ID_HASH = &fbISO3166_ISO639_Map::getCountryIDToLanguageIDHash();
		$country_id = strtoupper($country_id);
		return isset($COUNTRY_ID_TO_LANGUAGE_ID_HASH[$country_id])
			? $COUNTRY_ID_TO_LANGUAGE_ID_HASH[$country_id]
			: false;
	}

}

?>
