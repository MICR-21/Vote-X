// SPDX-License-Identifier: MIT
pragma solidity ^0.8.17;

contract Election {
    struct Candidate {
        string name;
        uint96 voteCount;
        uint8 id;
    }

    mapping(uint8 => Candidate) public candidates;
    mapping(address => bool) public voters;
    uint8 public candidatesCount;

    event VotedEvent(uint8 indexed _candidateId);

    error AlreadyVoted();
    error InvalidCandidateId();
    error NoCandidates();

    constructor() {
        candidatesCount = 0;
    }

    function addCandidate(string memory _name) public {
        unchecked {
            candidatesCount++;
        }
        candidates[candidatesCount] = Candidate(_name, 0, candidatesCount);
    }

    function vote(uint8 _candidateId) public {
        if (voters[msg.sender]) {
            revert AlreadyVoted();
        }
        if (_candidateId == 0 || _candidateId > candidatesCount) {
            revert InvalidCandidateId();
        }
        voters[msg.sender] = true;
        unchecked {
            candidates[_candidateId].voteCount++;
        }
        emit VotedEvent(_candidateId);
    }

    function getWinner() public view returns (string memory winnerName, uint256 totalVotes) {
        require(candidatesCount > 0, "No candidates available");

        uint96 maxVotes = 0;
        uint8 winnerId = 0;

        for (uint8 i = 1; i <= candidatesCount; i++) {
            if (candidates[i].voteCount > maxVotes) {
                maxVotes = candidates[i].voteCount;
                winnerId = i;
            }
        }

        winnerName = candidates[winnerId].name;
        totalVotes = maxVotes;
    }
}
