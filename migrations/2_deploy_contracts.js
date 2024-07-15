const Election = artifacts.require("Election");

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function deployWithRetry(deployer, maxRetries = 5, initialDelay = 1000) {
  let retries = 0;
  while (retries < maxRetries) {
    try {
      console.log(`Attempt ${retries + 1} to deploy Election contract...`);

      await deployer.deploy(Election, { gas: 5000000 });

      const electionInstance = await Election.deployed();
      console.log("Election contract deployed successfully at address:", electionInstance.address);
      return;
    } catch (error) {
      console.error(`Error during deployment attempt ${retries + 1}:`, error.message);

      if (error.message.includes('Too Many Requests') || error.message.includes('rate limit')) {
        const delay = initialDelay * Math.pow(2, retries);
        console.log(`Retrying in ${delay / 1000} seconds...`);
        await sleep(delay);
        retries++;
      } else {
        throw error; // If it's not a rate limiting error, throw it immediately
      }
    }
  }
  throw new Error('Max retries reached. Deployment failed.');
}

module.exports = async function(deployer, network) {
  if (network === 'quicknode') {
    await deployWithRetry(deployer);
  } else {
    try {
      console.log("Starting deployment of Election contract...");
      await deployer.deploy(Election, { gas: 5000000 });
      const electionInstance = await Election.deployed();
      console.log("Election contract deployed at address:", electionInstance.address);
    } catch (error) {
      console.error("Error during contract deployment:", error);
    }
  }
};

