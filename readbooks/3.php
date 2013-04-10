<?php 

# Step 3: Simplify the code removing duplication

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    
    // * here we have duplicated code because we test twice for empty data
    // * we could let the method readBooksById test for empty data and
    //   make it return an empty array in such cases.
    if (!empty($filteredGuids)) {
        $userData = $this->readBooksById($filteredGuids, $user);

        if (!empty($userData)) {
            $user->fromArray($userData);
        }
    }
}

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    $userData = $this->readBooksById($filteredGuids, $user);

    if (!empty($userData)) {
        $user->fromArray($userData);
    }
}

// * We still have an if that's not necessary. We could let fromArray to test for empty data
// * If we want to initialize the user state or reset it we can add the following two methods:
//   resetState() and initFromEmptyArray()

public function toggleReadBooks($guids, MyUserInterface $user)
{
    $filteredGuids = filter_read_books($guids, $user->getReadBooks());
    $userData = $this->readBooksById($filteredGuids, $user);
    $user->fromArray($userData);
}
