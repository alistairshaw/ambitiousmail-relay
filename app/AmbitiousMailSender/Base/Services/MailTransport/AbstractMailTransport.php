<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

abstract class AbstractMailTransport implements MailTransport {

	/**
	 * Finds instances of variables in a string and replaces them with the right value
	 * @param string $string
	 * @param array  $variables
	 * @return string
	 */
	protected function insertVariables($string, $variables = array())
	{
		foreach ($variables as $key => $value)
		{
			$string = str_replace('[[' . $key . ']]', $value, $string);
		}

		return $string;
	}

	/**
	 * @param $variables
	 * @return string
	 */
	protected function getNameFromVariables($variables)
	{
		$name[0] = '';
		$name[1] = '';

		foreach ($variables as $key => $value)
		{
			if ($key == 'first_name' || $key == 'firstname' || $key == 'name') $name[0] = $value;
			if ($key == 'last_name' || $key == 'lastname' || $key == 'surname') $name[1] = $value;
		}

		$finalName = [];
		foreach ($name as $nameSegment) if ($nameSegment !== '') $finalName[] = $nameSegment;

		return implode(" ", $finalName);
	}

}