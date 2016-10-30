run('C:\Users\micha\Documents\toolbox\vl_setup')
load('pos_neg_feats.mat')

feats = cat(1,pos_feats([1342:6713],:),neg_feats([1342:6713],:));
labels = cat(1,ones(pos_nImages-1341,1),-1*ones(neg_nImages-1341,1));

lambda = 0.05;
[w,b] = vl_svmtrain(feats',labels',lambda);

fprintf('Classifier performance on train data:\n')
confidences = [pos_feats([1:1342],:); neg_feats([1:1342],:)]*w + b;
tlabels = cat(1,ones(pos_nImages-5371,1),-1*ones(neg_nImages-5371,1));
[tp_rate, fp_rate, tn_rate, fn_rate] =  report_accuracy(confidences, tlabels);
save('my_svm.mat','w','b');