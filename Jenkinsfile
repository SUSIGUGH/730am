pipeline
{
agent any
stages
{

      stage('Build'){
            steps{
	    sh 'ls -ltr'
	    sh 'pwd'
                echo "I am in build"
                sh 'cd docker/mysql && docker build -t susimysql .'
                sh 'cd docker/php && docker build -t susiphp .'
            }
        }


	stage('Tag Image')
	{
	steps{
	       sh 'docker image tag susimysql susigugh/susimysql:l'
	       sh 'docker image tag susiphp susigugh/susiphp:l'
            }
        }


	stage('Push Image to Docker Hub')
	{
	steps{
        sh 'docker login -u=${udockersusigugh} -p=${pdockersusigugh} && docker push susigugh/susimysql:l'
        sh 'docker login -u=${udockersusigugh} -p=${pdockersusigugh} && docker push susigugh/susiphp:l'
	}
	}


stage('Deploy to Kubernetes')
{
steps
{
sh 'chmod 600 jmtksrv01.pem'
sh 'scp -i jmtksrv01.pem -o StrictHostKeyChecking=no kubernetes/*.yaml ec2-user@15.206.94.237:/home/ec2-user'
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "cd /home/ec2-user && kubectl create -f mysql.yaml && kubectl get pods -n dev"'
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "cd /home/ec2-user && kubectl create -f mysqlsrv.yaml && kubectl get services -n dev"'
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "cd /home/ec2-user && kubectl create -f php.yaml && kubectl get deployments -n dev"'
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "cd /home/ec2-user && kubectl create -f phpsrv.yaml && kubectl get deployments -n dev"'
sleep 60
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "nohup kubectl port-forward --address 0.0.0.0 services/php-srv 30034:80 -n dev &"'
sh 'ssh -i jmtksrv01.pem -o StrictHostKeyChecking=no ec2-user@15.206.94.237 "nohup kubectl port-forward --address 0.0.0.0 services/mysql-srv 30033:3306 -n dev &"'
}
}
// Test
//	stage('IaC')
//	{
//	steps
//	{
//	sh 'cd tr && terraform init && terraform plan && terraform apply -auto-approve && terraform destroy -auto-approve'
//	}
//	}

}
}

