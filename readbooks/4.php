<?php 

# Step 4: return a new $userData instead of making an in place modification of $user

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    $userData = $this->readBooksById($filteredGuids, $user);
    $user->fromArray($userData);
}

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    return $this->readBooksById($filteredGuids, $user);
}
