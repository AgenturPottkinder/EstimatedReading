# Pottkinder: EstimateReading

This small TYPO3 v8.7 Extension provides you the possibility to display information of given string. For example it displays the time you normally need to read an article, counts chars and sentences for you and is able to work with different articles on the same page if required.

## Important:

This script is not for academic usage. It is counting and not calculating and that very unprecise, as it is no language KI but a small script. This is what is does:

* Remove all tags
* count chars by string length
* count words by space separation
* count sentences by finding `.`, `!` and `?`
* calculating required time based on amount of words. No magic here.

# Usage

## Collecting Chars and Sentences

There is a new ViewHelper available which you are allowed to put around your normal content and that should be everything. The viewhelper needs to get a keyword to identify what you are currently tracking. This way you are able to also collect list entries for example.

Of course you are able to use the same keyword a few times. That way this extension is just adding the given string length together so you have one longer text. So you are able to drop advertisment of navigations if required.

To collect information for our normal content output we just need to enable the namespace and wrap our `f:format.raw` tag like this:

```
{namespace estimateReading = Pottkinder\Estimatedreading\ViewHelpers}

<estimateReading:CollectString keyword="test">
    <f:format.raw>{content}</f:format.raw>
</estimateReading:CollectString>
```

Will be rendered to:

```
hello world
```

If `{content}` equals `hello world`.

## Viewing Time and Statistics

```
{namespace estimateReading = Pottkinder\Estimatedreading\ViewHelpers}
Reading this 
<estimateReading:EstimateReading keyword="test" variable="chars" /> chars long text requires you: 
<estimateReading:EstimateReading keyword="test" variable="hours" /> hours,
<estimateReading:EstimateReading keyword="test" variable="minutes" /> minutes and
<estimateReading:EstimateReading keyword="test" variable="seconds" /> seconds
```

Will be rendered to:

```
Reading this 400 chars long text requires you:
1 hours,
2 minutes and
20 seconds
```

## Fields to use

As read above you are able to use some variables for your keyword. Here is a list what you are able to use:

| Fieldname          | Description                                         | Example  |
| ------------------ |-----------------------------------------------------| --------:|
| chars              | Shows amount of chars in block                      | 54321    |
| charsWithoutSpaces | Shows amount of chars without spaces                | 45123    |
| words              | Shows amount of words in block                      | 700      |
| sentences          | Shows amount of sentences in block                  | 250      |
| totalSeconds       | Shows amount of calulated seconds                   | 5431     |
| totalMinutes       | Shows amount of minutes in total (unrounded)        | 90       |
| roundedMinutes     | Shows amount of rounded Minutes (without hours)     | 31       |
| hours              | Shows amount of hours                               | 1        |
| minutes            | Shows amount of minutes (without hours)             | 30       |
| seconds            | Shows amount of seconds (without hours and minutes) | 31       |


# Support and Disclamer

This extension is written by Bastian Bringenberg for Agentur Pottkinder based in Bochum, Germany.

If you need support or find a bug please open a ticket here on github. If you find a security problem or need a payed extension please send me a mail to <bastian@agentur-pottkinder.de>.

This extension is for free use but please respect the GPLv2 rights. This extension is like all extensions under GPLv2 ( https://typo3.org/index.php?id=782 ).