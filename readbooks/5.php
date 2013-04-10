<?php

# Paso 5: this code is still hard to test since the $user variable can be hard to mock.

# Where are we using the $user object in this code?
// * We use it to get the read articles by calling getReadBooks
// * It's also used by the readBooksById method

// The read articles can be passed as an array to toggleReadBooks
// but we still need the $user object for readBooksById

# Here's readBooksById:

public function readBooksById($guid, $user, $read = true)
{
    $response = $this->buzzBrowser->put(
        $this->url.'/user/'.$user->getUsername().'.json',
        array('Content-Type: application/x-www-form-urlencoded'),
        http_build_query(array($read ? 'read_article_id' : 'unread_article_id' => $guid))
    );

    if (isset($response) && $response->getStatusCode() === 200) {
        return json_decode($response->getContent(), true);
    }

    return null;
}


// $user it's only used to get the username by calling "getUsername".
// we can just pass the $userName.

public function readBooksById($guid, $userName, $read = true)
{
    $response = $this->buzzBrowser->put(
        $this->url.'/user/'.$userName.'.json',
        array('Content-Type: application/x-www-form-urlencoded'),
        http_build_query(array($read ? 'read_article_id' : 'unread_article_id' => $guid))
    );

    if (isset($response) && $response->getStatusCode() === 200) {
        return json_decode($response->getContent(), true);
    }

    return null;
}


public function toggleReadBooks($guids, $username, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    return $this->readBooksById($filteredGuids, $username);
}

// And now we pass an array with the $readBooks

public function toggleReadBooks($guids, $username, $readBooks)
{
    $filteredGuids = filter_read_books($guids, $readBooks);
    return $this->readBooksById($filteredGuids, $username);
}

// And of course our code is now easier to compose.

public function toggleReadBooks($guids, $username, $readBooks) {
    return $this->readBooksById(filter_read_books($guids, $readBooks), $username);
}